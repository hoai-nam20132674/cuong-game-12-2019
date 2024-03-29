//by @wonglok831
//MIT Licensed

var util = {

  prepShader: (gl, shaderSource, shaderType) => {
    var webGLShader = gl.createShader(shaderType);
    gl.shaderSource(webGLShader, shaderSource);
    gl.compileShader(webGLShader);

    var success = gl.getShaderParameter(webGLShader, gl.COMPILE_STATUS);
    if (!success) {
      var error = gl.getShaderInfoLog(webGLShader);
      console.error(error);
    }

    return webGLShader;
  },

  prepProgram: (gl, vShader, fShader) => {
    var program = gl.createProgram();

    gl.attachShader(program, vShader);
    gl.attachShader(program, fShader);

    gl.linkProgram(program);

    var success = gl.getProgramParameter(program, gl.LINK_STATUS);
    if (!success) {
      var error = gl.getProgramInfoLog(program);
      console.error(error);
    }

    return program;
  } };




class Lines {

  constructor(count) {

    this.count = count;
    this.group = 3;
    this.vertex = new Float32Array(count * 6);
    this.lines = [];

    this.setup();

  }

  setup() {
    for (var i = 0; i < this.count; i++) {
      this.lines.push(
      new Line(this.vertex, i, i % 4));

    }
  }

  update(cb) {
    this.lines.forEach(cb);
  }}



//Nature of Code Book and with my remix
class Mover2D {

  constructor(pX, pY, pZ, mass) {
    var Vector3 = THREE.Vector3;

    this.position = new Vector3(pX, pY, pZ);
    this.velocity = new Vector3(0, 0, 0);
    this.acceleration = new Vector3(0, 0, 0);
    this.mass = mass || 1;
    this.G = 1;

  }

  applyForce(force) {
    var f = force.clone().divideScalar(this.mass);
    this.acceleration.add(f);
  }

  update() {
    this.velocity.add(this.acceleration);
    this.position.add(this.velocity);
    this.acceleration.multiplyScalar(0);
    this.theta = Math.atan2(this.velocity.y, this.velocity.x);
  }

  constrain(val, min, max) {
    if (val < min) {
      return min;
    } else if (val > max) {
      return max;
    } else {
      return val;
    }
  }

  attract(mover) {

    var force = this.position.clone().sub(mover.position);
    var distance = force.length();
    var d = this.constrain(distance, 10.0, 50.0);
    force.normalize();
    var strength = this.G * this.mass * this.mass / (d * d);
    force.multiplyScalar(strength);
    return force;

  }

  repel(mover) {

    var force = this.position.clone().sub(mover.position);
    var distance = force.length();
    var d = this.constrain(distance, 10.0, 50.0);
    force.normalize();
    var strength = this.G * this.mass * this.mass / (d * d) * -1;
    force.multiplyScalar(strength);
    return force;

  }

  suckBack(width, height, depth) {

    if (this.position.x > width) {
      this.velocity.x *= 0.99;
      this.velocity.y *= 0.99;
      this.velocity.z *= 0.99;
    } else if (this.position.x < 0) {
      this.velocity.x *= 0.99;
      this.velocity.y *= 0.99;
      this.velocity.z *= 0.99;
    }

    if (this.position.y > height) {
      this.velocity.x *= 0.99;
      this.velocity.y *= 0.99;
      this.velocity.z *= 0.99;
    } else if (this.position.y < 0) {
      this.velocity.x *= 0.99;
      this.velocity.y *= 0.99;
      this.velocity.z *= 0.99;
    }

    if (this.position.y > depth) {
      this.velocity.x *= 0.99;
      this.velocity.y *= 0.99;
      this.velocity.z *= 0.99;
    } else if (this.position.y < -1) {
      this.velocity.x *= 0.99;
      this.velocity.y *= 0.99;
      this.velocity.z *= 0.99;
    }

  }}



class Line {
  constructor(vertex, index) {
    this.vertex = vertex;

    var offset = 6;
    this.index = index;
    this.r1 = Math.random();
    this.r2 = Math.random();
    this.r3 = Math.random();

    this.r4 = Math.random();
    this.r5 = Math.random();
    this.r6 = Math.random();

    this.x0 = index * offset + 0;
    this.y0 = index * offset + 1;
    this.z0 = index * offset + 2;

    this.x1 = index * offset + 3;
    this.y1 = index * offset + 4;
    this.z1 = index * offset + 5;


    this.bindedUpdate = this.update.bind(this);

    this.setup();
  }

  setup(x0, y0, z0, x1, y1, z1) {
    this.vertex[this.x0] = x0;
    this.vertex[this.y0] = y0;
    this.vertex[this.z0] = z0;

    this.vertex[this.x1] = x1;
    this.vertex[this.y1] = y1;
    this.vertex[this.z1] = z1;

    return this;
  }

  update(x0, y0, z0, x1, y1, z1) {
    this.vertex[this.x0] = x0;
    this.vertex[this.y0] = y0;
    this.vertex[this.z0] = z0;

    this.vertex[this.x1] = x1;
    this.vertex[this.y1] = y1;
    this.vertex[this.z1] = z1;

  }

  gD(key) {
    return this.vertex[this[key]];
  }}




class PerspectiveCamera {
  constructor(gl) {
    this.gl = gl;
    var mat4 = window.mat4;
    this.pMatrix = mat4.create();
    this.mvMatrix = mat4.create();

    this.yAxis = [1.0, 0.0, 0.0];
    this.xAxis = [0.0, 1.0, 0.0];

    var state = this.state = {};
    state.tiltX = 20;
    state.tiltY = 28.5;
    state.zoom = -2.5;
  }
  tick() {
    var state = this.state;
    state.tiltX += 0.5;
  }
  reCalc() {
    var state = this.state;
    var gl = this.gl;
    //set the perspective of the view
    mat4.perspective(this.pMatrix, 45, gl.canvas.width / gl.canvas.height, 0.1, 1000.0);

    //model view matrix (mdoel translation)
    mat4.identity(this.mvMatrix);
    mat4.translate(this.mvMatrix, this.mvMatrix, [0.0, 0.0, state.zoom]);

    mat4.rotate(this.mvMatrix, this.mvMatrix, this.degToRad(state.tiltY), this.yAxis);
    mat4.rotate(this.mvMatrix, this.mvMatrix, this.degToRad(state.tiltX), this.xAxis);
  }

  degToRad(degree) {
    return degree * Math.PI / 180;
  }}




class Unis {
  constructor({
    gl,
    keys,
    program })
  {
    this.gl = gl;
    this.loc = {};

    keys.forEach(item => {
      this.loc[item] = gl.getUniformLocation(program, item);
    });

  }

  upload1f(key, val) {
    var gl = this.gl;
    gl.uniform1f(this.loc[key], val);
  }
  upload1i(key, val) {
    var gl = this.gl;
    gl.uniform1i(this.loc[key], val);
  }
  upload4m(key, val) {
    var gl = this.gl;
    gl.uniformMatrix4fv(this.loc[key], false, val);
  }}



class ModeSwitcher {

  constructor(max) {
    this.maxModeIndex = max;
    this.start = 0;

    this.mode = this.start;
    this.repel = false;

    this.b = {
      tick: this.tickMode(this) };


    setInterval(() => {
      if (this.down) {return;}
      this.goRepel();
    }, 5555);

  }

  tickMode() {
    this.mode++;
    this.mode = this.mode % this.maxModeIndex;
  }
  goDown() {
    this.down = true;
  }
  goUp() {
    this.down = false;
  }

  goRepel() {
    this.repel = true;
    if (this.timeout) {
      clearTimeout(this.timeout);
    }
    this.timeout = setTimeout(() => {
      this.repel = false;
      this.tickMode();
    }, 1386);
  }

  rightClick() {
    this.goRepel();
    this.tickMode();
  }
  twoFingers() {
    this.goRepel();
    this.tickMode();
  }}





window.onload = () => {
  var canvas = document.createElement('canvas');

  document.body.appendChild(canvas);
  var gl = canvas.getContext('webgl', { antialias: true });

  var vertexSource = `
    attribute vec3 a_position;
    varying vec3 v_position;
    
    uniform mat4 u_pMatrix;
    uniform mat4 u_mvMatrix;
    

    void main() {
      gl_Position = u_pMatrix * u_mvMatrix * vec4(a_position, 1);
      gl_PointSize = 1.0;
      v_position = a_position;
    }
  `;

  var fragmentSource = `
    precision lowp float;

    varying vec3 v_position;
    void main() {
     gl_FragColor = vec4(
                      v_position.x + 0.5, 
                      v_position.y + 0.5, 
                      v_position.z + 0.5, 
                      0.33
                    );
   }
  `;

  var vertexShader = util.prepShader(gl, vertexSource, gl.VERTEX_SHADER);
  var fragmentShader = util.prepShader(gl, fragmentSource, gl.FRAGMENT_SHADER);
  var program = util.prepProgram(gl, vertexShader, fragmentShader);

  gl.useProgram(program);

  var camera = new PerspectiveCamera(gl);

  var uniforms = new Unis({
    gl: gl,
    program: program,
    keys: [
    'u_pMatrix',
    'u_mvMatrix'] });



  camera.reCalc();
  uniforms.upload4m('u_pMatrix', camera.pMatrix);
  uniforms.upload4m('u_mvMatrix', camera.mvMatrix);


  var lines = new Lines(888);

  var linesBuffer = gl.createBuffer();
  gl.bindBuffer(gl.ARRAY_BUFFER, linesBuffer);
  gl.bufferData(
  gl.ARRAY_BUFFER,
  lines.vertex,
  gl.DYNAMIC_DRAW);

  var positionLocation = gl.getAttribLocation(program, "a_position");
  gl.enableVertexAttribArray(positionLocation);
  gl.vertexAttribPointer(positionLocation, lines.group, gl.FLOAT, false, 0, 0);
  gl.bindBuffer(gl.ARRAY_BUFFER, null);

  var gravityCenter = new Mover2D(
  0,
  0,
  0,
  0.15);


  var modeSwitcher = new ModeSwitcher(5);

  var cX = 0,cY = 0,mX = 0,mY = 0;
  var dt = 0;
  var dtr = 0;
  var oldTime = window.performance.now();

  var tempV = new THREE.Vector3(0.5, 0.5, 0.5);

  var updateTriangle = (triangle, i) => {

    gravityCenter.position.x = cX;
    gravityCenter.position.y = cY;
    gravityCenter.position.z = 0;

    let mover = triangle.mover;
    let mp = mover.position;
    let mv = mover.velocity;

    let pX = mp.x;
    let pY = mp.y;
    let pZ = mp.z;
    let vX = mv.x;
    let vY = mv.y;
    let vZ = mv.z;
    let pL = Math.abs(mp.length() - mv.length());


    var force;
    if (modeSwitcher.repel) {
      force = gravityCenter.repel(mover);
    } else {
      force = gravityCenter.attract(mover);
    }
    mover.applyForce(force);
    mover.update();
    mover.suckBack(1.0, 1.0);

    // triangle.update(
    //   pX, pY, pZ, 
    //   pX, pY, pZ, 
    //   pX, pY, pZ
    // );

  };

  var updateLine = (line, i) => {

    gravityCenter.position.x = cX;
    gravityCenter.position.y = cY;
    gravityCenter.position.z = 0;

    let mover = line.mover;
    let mp = mover.position;
    let mv = mover.velocity;

    let pX = mp.x;
    let pY = mp.y;
    let pZ = mp.z;
    let vX = mv.x;
    let vY = mv.y;
    let vZ = mv.z;
    let pL = Math.abs(mp.length() - mv.length());


    // let pL = mover.position.lengthSq();

    var force;
    if (modeSwitcher.repel) {
      force = gravityCenter.repel(mover);
    } else {
      force = gravityCenter.attract(mover);
    }
    mover.applyForce(force);
    mover.update();
    mover.suckBack(1.0, 1.0);

    line.update(
    pX - vX * pL * 3, pY - vY * pL * 3, pZ - vZ * pL * 3,
    pX, pY, pZ);



  };



  var initLine = (line, i) => {

    line.mover = new Mover2D(
    (-0.5 + Math.random()) * 2,
    (-0.5 + Math.random()) * 2,
    (-0.5 + Math.random()) * 2,

    0.10 + 0.15 * Math.random());

    tempV.setFromSpherical({
      radius: 1.0,
      phi: i / lines.count * Math.PI * 2,
      theta: i % Math.sqrt(lines.count) / lines.count * Math.PI * 2 });

    line.mover.position.sub(tempV);
  };

  lines.update(initLine);


  var rAF = time => {
    window.requestAnimationFrame(rAF);
    dt = (oldTime - time) / 1000;
    dtr = (time - oldTime) / 1000;
    //oldTime = time;

    lines.update(updateLine);

    gl.viewport(0, 0, gl.canvas.width, gl.canvas.height);
    gl.clearColor(0, 0, 0, 1.0);
    gl.clear(gl.COLOR_BUFFER_BIT);

    gl.enable(gl.BLEND);
    gl.blendFunc(gl.ONE, gl.ONE_MINUS_SRC_ALPHA);

    camera.tick();
    camera.reCalc();
    uniforms.upload4m('u_pMatrix', camera.pMatrix);
    uniforms.upload4m('u_mvMatrix', camera.mvMatrix);

    gl.bindBuffer(gl.ARRAY_BUFFER, linesBuffer);
    gl.vertexAttribPointer(positionLocation, lines.group, gl.FLOAT, false, 0, 0);
    gl.enableVertexAttribArray(positionLocation);
    gl.bufferData(
    gl.ARRAY_BUFFER,
    lines.vertex,
    gl.DYNAMIC_DRAW);

    gl.drawArrays(gl.LINES, 0, lines.count);

    gl.bindBuffer(gl.ARRAY_BUFFER, null);



  };

  window.requestAnimationFrame(rAF);


  window.document.addEventListener('mousemove', function (evt) {
    mX = evt.pageX;
    mY = -1 * evt.pageY;

    cX = (evt.pageX - window.innerWidth / 2) / window.innerWidth;
    cY = -1 * (evt.pageY - window.innerHeight / 2) / window.innerHeight;

  }, false);
  window.document.addEventListener('mouseleave', function (evt) {
    mX = 0;
    mY = 0;

    cX = 0;
    cY = 0;
  }, false);
  window.document.addEventListener('mousedown', function (evt) {
    evt.preventDefault();

    modeSwitcher.goDown();
  }, false);
  window.document.addEventListener('mouseup', function (evt) {
    evt.preventDefault();

    modeSwitcher.goUp();
  }, false);
  window.oncontextmenu = function () {
    modeSwitcher.rightClick();
    return false; // cancel default menu
  };


  window.document.addEventListener('touchstart', function (evt) {
    evt.preventDefault();
    modeSwitcher.goDown();
    if (evt.targetTouches.length >= 2) {
      modeSwitcher.twoFingers();
    }
  }, false);
  window.document.addEventListener('touchmove', function (evt) {
    evt.preventDefault();
    mX = -1 * evt.targetTouches[0].clientX;
    mY = evt.targetTouches[0].clientY;

    cX = -1 * (window.innerWidth / 2 - evt.targetTouches[0].clientX) / window.innerWidth;
    cY = (window.innerHeight / 2 - evt.targetTouches[0].clientY) / window.innerHeight;

  }, false);
  window.document.addEventListener('touchend', function (evt) {
    evt.preventDefault();
    mX = 0;
    cX = 0;
    mY = 0;
    cY = 0;

    modeSwitcher.goUp();
  }, false);

  function resizer() {
    var realToCSSPixels = window.devicePixelRatio || 1;
    realToCSSPixels = 1;
    // Lookup the size the browser is displaying the canvas in CSS pixels
    // and compute a size needed to make our drawingbuffer match it in
    // device pixels.
    var displayWidth = Math.floor(gl.canvas.clientWidth * realToCSSPixels);
    var displayHeight = Math.floor(gl.canvas.clientHeight * realToCSSPixels);

    // Check if the canvas is not the same size.
    if (gl.canvas.width !== displayWidth ||
    gl.canvas.height !== displayHeight) {

      // Make the canvas the same size
      gl.canvas.width = displayWidth;
      gl.canvas.height = displayHeight;
    }

    // canvas.width = window.innerWidth;
    // canvas.height = window.innerHeight;
  }
  window.addEventListener('resize', resizer, true);
  resizer();



};




(function () {

  /* Copyright (c) 2013, Brandon Jones, Colin MacKenzie IV. All rights reserved.
              Redistribution and use in source and binary forms, with or without modification,
              are permitted provided that the following conditions are met:
               * Redistributions of source code must retain the above copyright notice, this
                list of conditions and the following disclaimer.
              * Redistributions in binary form must reproduce the above copyright notice,
                this list of conditions and the following disclaimer in the documentation
                and/or other materials provided with the distribution.
              THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
              ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
              WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
              DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR
              ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
              (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
              LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
              ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
              (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
              SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. */




  var mat4 = window.mat4 = {};

  mat4.create = function () {
    var out = new Float32Array(16);
    out[0] = 1;
    out[1] = 0;
    out[2] = 0;
    out[3] = 0;
    out[4] = 0;
    out[5] = 1;
    out[6] = 0;
    out[7] = 0;
    out[8] = 0;
    out[9] = 0;
    out[10] = 1;
    out[11] = 0;
    out[12] = 0;
    out[13] = 0;
    out[14] = 0;
    out[15] = 1;
    return out;
  };

  mat4.identity = function (out) {
    out[0] = 1;
    out[1] = 0;
    out[2] = 0;
    out[3] = 0;
    out[4] = 0;
    out[5] = 1;
    out[6] = 0;
    out[7] = 0;
    out[8] = 0;
    out[9] = 0;
    out[10] = 1;
    out[11] = 0;
    out[12] = 0;
    out[13] = 0;
    out[14] = 0;
    out[15] = 1;
    return out;
  };

  mat4.perspective = function (out, fovy, aspect, near, far) {
    var f = 1.0 / Math.tan(fovy / 2),
    nf = 1 / (near - far);
    out[0] = f / aspect;
    out[1] = 0;
    out[2] = 0;
    out[3] = 0;
    out[4] = 0;
    out[5] = f;
    out[6] = 0;
    out[7] = 0;
    out[8] = 0;
    out[9] = 0;
    out[10] = (far + near) * nf;
    out[11] = -1;
    out[12] = 0;
    out[13] = 0;
    out[14] = 2 * far * near * nf;
    out[15] = 0;
    return out;
  };

  mat4.translate = function (out, a, v) {
    var x = v[0],
    y = v[1],
    z = v[2],
    a00,a01,a02,a03,
    a10,a11,a12,a13,
    a20,a21,a22,a23;

    if (a === out) {
      out[12] = a[0] * x + a[4] * y + a[8] * z + a[12];
      out[13] = a[1] * x + a[5] * y + a[9] * z + a[13];
      out[14] = a[2] * x + a[6] * y + a[10] * z + a[14];
      out[15] = a[3] * x + a[7] * y + a[11] * z + a[15];
    } else {
      a00 = a[0];
      a01 = a[1];
      a02 = a[2];
      a03 = a[3];
      a10 = a[4];
      a11 = a[5];
      a12 = a[6];
      a13 = a[7];
      a20 = a[8];
      a21 = a[9];
      a22 = a[10];
      a23 = a[11];

      out[0] = a00;
      out[1] = a01;
      out[2] = a02;
      out[3] = a03;
      out[4] = a10;
      out[5] = a11;
      out[6] = a12;
      out[7] = a13;
      out[8] = a20;
      out[9] = a21;
      out[10] = a22;
      out[11] = a23;

      out[12] = a00 * x + a10 * y + a20 * z + a[12];
      out[13] = a01 * x + a11 * y + a21 * z + a[13];
      out[14] = a02 * x + a12 * y + a22 * z + a[14];
      out[15] = a03 * x + a13 * y + a23 * z + a[15];
    }

    return out;
  };

  mat4.rotate = function (out, a, rad, axis) {
    var x = axis[0],
    y = axis[1],
    z = axis[2],
    len = Math.sqrt(x * x + y * y + z * z),
    s,c,t,
    a00,a01,a02,a03,
    a10,a11,a12,a13,
    a20,a21,a22,a23,
    b00,b01,b02,
    b10,b11,b12,
    b20,b21,b22;

    var GLMAT_EPSILON = 0.000001;

    if (Math.abs(len) < GLMAT_EPSILON) {
      return null;
    }

    len = 1 / len;
    x *= len;
    y *= len;
    z *= len;

    s = Math.sin(rad);
    c = Math.cos(rad);
    t = 1 - c;

    a00 = a[0];
    a01 = a[1];
    a02 = a[2];
    a03 = a[3];
    a10 = a[4];
    a11 = a[5];
    a12 = a[6];
    a13 = a[7];
    a20 = a[8];
    a21 = a[9];
    a22 = a[10];
    a23 = a[11];

    // Construct the elements of the rotation matrix
    b00 = x * x * t + c;
    b01 = y * x * t + z * s;
    b02 = z * x * t - y * s;
    b10 = x * y * t - z * s;
    b11 = y * y * t + c;
    b12 = z * y * t + x * s;
    b20 = x * z * t + y * s;
    b21 = y * z * t - x * s;
    b22 = z * z * t + c;

    // Perform rotation-specific matrix multiplication
    out[0] = a00 * b00 + a10 * b01 + a20 * b02;
    out[1] = a01 * b00 + a11 * b01 + a21 * b02;
    out[2] = a02 * b00 + a12 * b01 + a22 * b02;
    out[3] = a03 * b00 + a13 * b01 + a23 * b02;
    out[4] = a00 * b10 + a10 * b11 + a20 * b12;
    out[5] = a01 * b10 + a11 * b11 + a21 * b12;
    out[6] = a02 * b10 + a12 * b11 + a22 * b12;
    out[7] = a03 * b10 + a13 * b11 + a23 * b12;
    out[8] = a00 * b20 + a10 * b21 + a20 * b22;
    out[9] = a01 * b20 + a11 * b21 + a21 * b22;
    out[10] = a02 * b20 + a12 * b21 + a22 * b22;
    out[11] = a03 * b20 + a13 * b21 + a23 * b22;

    if (a !== out) {// If the source and destination differ, copy the unchanged last row
      out[12] = a[12];
      out[13] = a[13];
      out[14] = a[14];
      out[15] = a[15];
    }
    return out;
  };

})();
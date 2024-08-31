// Source for bezier curve function used throughout file: https://www.w3schools.com/tags/canvas_beziercurveto.asp

function drawCircle(graphics, x, y, radius, linecolor, fillcolor){ //adapted from https://www.w3schools.com/tags/canvas_arc.asp
  graphics.strokeStyle = linecolor;
  graphics.beginPath();
  graphics.arc(x,y,radius,0,2*Math.PI);
  graphics.stroke();
  graphics.fillStyle = fillcolor;
  graphics.fill();
}

function drawLine(graphics, points, linecolor, linewidth){
  graphics.strokeStyle = linecolor;
  graphics.lineWidth = linewidth;
  graphics.beginPath();
  graphics.moveTo(points[0][0], points[0][1]);
  for(var i=0; i<points.length; i++){
    graphics.lineTo(points[i][0], points[i][1]);
  }
  graphics.stroke();
}

function drawAvatar0(id){ //8th notes
  var canvas = document.getElementById(id);
  var graphics = canvas.getContext("2d");
  drawCircle(graphics, 23, 65, 10, "black", "black");
  drawCircle(graphics, 63, 65, 10, "black", "black");
  drawLine(graphics, [[31,65], [31,15], [71,15], [71,65]], "black", 5);
}

function drawAvatar1(id){ //bass clef
  var canvas = document.getElementById(id);
  var graphics = canvas.getContext("2d");
  drawCircle(graphics, 33, 50, 8, "black", "black");
  drawCircle(graphics, 75, 40, 4, "black", "black");
  drawCircle(graphics, 75, 60, 4, "black", "black");

  graphics.beginPath();
  graphics.moveTo(29,55);
  graphics.bezierCurveTo(10,35,45,20,55,25);
  graphics.bezierCurveTo(70,30,70,70,29,85);
  graphics.lineWidth = 5;
  graphics.stroke();
}

function drawAvatar2(id){ //piano
  var canvas = document.getElementById(id);
  var graphics = canvas.getContext("2d");

  //draw outer rectangle
  drawLine(graphics, [[10,30],[90,30],[90,70],[10,70],[10,30]], "black", "black");
  
  //draw white key separations
  graphics.beginPath();
  graphics.moveTo(20,30);
  graphics.lineTo(20,70);
  graphics.moveTo(30,30);
  graphics.lineTo(30,70);
  graphics.moveTo(40,30);
  graphics.lineTo(40,70);
  graphics.moveTo(50,30);
  graphics.lineTo(50,70);
  graphics.moveTo(60,30);
  graphics.lineTo(60,70);
  graphics.moveTo(70,30);
  graphics.lineTo(70,70);
  graphics.moveTo(80,30);
  graphics.lineTo(80,70);
  graphics.stroke();

  //draw black keys
  graphics.lineWidth = 5;
  graphics.beginPath();
  graphics.moveTo(20,30);
  graphics.lineTo(20,50);
  graphics.moveTo(30,30);
  graphics.lineTo(30,50);
  graphics.moveTo(50,30);
  graphics.lineTo(50,50);
  graphics.moveTo(60,30);
  graphics.lineTo(60,50);
  graphics.moveTo(70,30);
  graphics.lineTo(70,50);
  graphics.stroke();
}

function drawAvatar3(id){ //violin side
  var canvas = document.getElementById(id);
  var graphics = canvas.getContext("2d");
  graphics.beginPath();
  graphics.moveTo(80,0);
  graphics.bezierCurveTo(50,-10,45,30,50,30);

  graphics.bezierCurveTo(52,38,45,40,45,38);
  graphics.lineTo(48,46);
  graphics.bezierCurveTo(65,40,65,75,48,70);
  graphics.lineTo(46,76);
  graphics.bezierCurveTo(55,80,50,85,45,90);
  graphics.bezierCurveTo(40,110,40,110,50,120);
  graphics.lineTo(200,200);
  graphics.closePath();
  graphics.fillStyle = "black";
  graphics.fill();
}

function drawAvatar4(id){ //treble clef
  var canvas = document.getElementById(id);
  var graphics = canvas.getContext("2d");
  drawCircle(graphics, 40, 80, 3, "black", "black");

  graphics.beginPath();
  graphics.moveTo(36,80);
  graphics.bezierCurveTo(60,120,50,10,50,18);
  graphics.bezierCurveTo(60,-10,70,30,50,40);
  graphics.bezierCurveTo(30,50,30,65,50,70);
  graphics.bezierCurveTo(80,80,80,50,50,50);
  graphics.bezierCurveTo(40,60,50,60,58,60);
  graphics.lineWidth = 2;
  graphics.stroke();
}
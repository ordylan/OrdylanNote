<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD("橙鸭笔记系统V2","游戏_网格作图","#","","");?>
<div id="console-output">error:</div>

    <script>
      const consoleOutput = document.getElementById('console-output');
      window.onerror = function(message, source, lineno, colno, error) {
        const textNode = document.createTextNode(`Error: ${message} (line ${lineno})`);
        consoleOutput.appendChild(textNode);
        consoleOutput.appendChild(document.createElement('br'));

        //return true;
      };
    </script>


  <canvas id="myCanvas" width="700" height="700" style="border:1px solid #000000;"></canvas>

<script>
const canvas = document.getElementById('myCanvas');
const ctx = canvas.getContext('2d');

/*const ques = [
    '100,200,38,94',
    '112,652,233,534',
    '89,10,13',
    '888,888'
    // ... 添加其他点对
];*/
const ques = [
    '0,0,700,0',
    '0,100,700,100',
    '0,200,700,200',
    '0,300,700,300',
    '0,400,700,400',
    '0,500,700,500',
    '0,600,700,600',
    '0,700,700,700',
    '0,0,0,700',
    '100,0,100,700',
    '200,0,200,700',
    '300,0,300,700',
    '400,0,400,700',
    '500,0,500,700',
    '600,0,600,700',
    '700,0,700,700',
    
    '100,100,244.948974278',
    '300,300,141.42135623731',
    '100,123,555,660'


];

//let points = [];

function findIntersection(lineEq, x, y, r) {
    if (lineEq.vertical) {
        // Handle vertical lines
        const dx = Math.abs(lineEq.x - x);
        if (dx > r) {
            return []; // No intersection
        }
        const dy = Math.sqrt(r * r - dx * dx);
        const y1 = y + dy;
        const y2 = y - dy;

        if (Math.abs(dy) < 1e-6) {
            return [{ x: lineEq.x, y: y1 }];
        } else {
            return [{ x: lineEq.x, y: y1 }, { x: lineEq.x, y: y2 }];
        }
    }

    const { m, b } = lineEq;

    // Quadratic equation constants
    const A = 1 + m * m;
    const B = -2 * x - 2 * m * (b - y);
    const C = x * x + (b - y) * (b - y) - r * r;
    const discriminant = B * B - 4 * A * C;

    if (discriminant < 0) {
        return []; // No intersection
    } else {
        // Calculate intersection points
        const x1 = (-B + Math.sqrt(discriminant)) / (2 * A);
        const y1 = m * x1 + b;
        const x2 = (-B - Math.sqrt(discriminant)) / (2 * A);
        const y2 = m * x2 + b;

        if (discriminant === 0) {
            return [{ x: x1, y: y1 }];
        } else {
            return [{ x: x1, y: y1 }, { x: x2, y: y2 }];
        }
    }
}

function pointExists(points, x, y, epsilon = 1e-6) {
    return points.some(point => {
        const [px, py] = point.split(',').map(Number);
        return Math.abs(px - x) < epsilon && Math.abs(py - y) < epsilon;
    });
}

function findLineEquation(x1, y1, x2, y2) {
    if (x1 === x2) {
        return { vertical: true, x: x1 }; // Vertical line
    }

    const m = (y2 - y1) / (x2 - x1);
    const b = y1 - m * x1;

    return { m, b };
}

function findLineIntersection(lineEq1, lineEq2) {
    if (lineEq1.vertical && lineEq2.vertical) {
        return null; // Both lines are vertical and parallel, no intersection
    }

    if (lineEq1.vertical) {
        return { x: lineEq1.x, y: lineEq2.m * lineEq1.x + lineEq2.b }; // Intersection with vertical lineEq1
    }

    if (lineEq2.vertical) {
        return { x: lineEq2.x, y: lineEq1.m * lineEq2.x + lineEq1.b }; // Intersection with vertical lineEq2
    }

    if (Math.abs(lineEq1.m - lineEq2.m) < 1e-6) {
        return null; // Lines are parallel, no intersection
    }

    const x = (lineEq2.b - lineEq1.b) / (lineEq1.m - lineEq2.m);
    const y = lineEq1.m * x + lineEq1.b;

    return { x, y };
}

function isInsideCanvas(x, y) {
    return x >= 0 && x <= 700 && y >= 0 && y <= 700;
}

function isOnLineSegment(x, y, x1, y1, x2, y2) {
    const minX = Math.min(x1, x2);
    const maxX = Math.max(x1, x2);
    const minY = Math.min(y1, y2);
    const maxY = Math.max(y1, y2);

    return x >= minX && x <= maxX && y >= minY && y <= maxY;
}



function calculateIntersections(ques) {
    let points = [];

    for (let i = 0; i < ques.length; i++) {
        const values = ques[i].split(',').map(Number);
        if (values.length === 3) {
            // Element represents a circle
            const [cx, cy, r] = values;
            for (let j = 0; j < ques.length; j++) {
                if (i !== j && valuesAreLineSegment(ques[j])) {
                    const lineValues = ques[j].split(',').map(Number);
                    const [x1, y1, x2, y2] = lineValues;
                    const lineEq = findLineEquation(x1, y1, x2, y2);
                    const intersections = findIntersection(lineEq, cx, cy, r);

                    for (const intersection of intersections) {
                        const { x, y } = intersection;
                        if (!isNaN(x) && !isNaN(y) && !pointExists(points, x, y) && isInsideCanvas(x, y) && isOnLineSegment(x, y, x1, y1, x2, y2)) {
                            points.push(`${x},${y}`);
                        }
                    }
                }
            }
        } else if (values.length === 4) {
            // Element represents a line segment
            const [x1, y1, x2, y2] = values;
            const lineEq = findLineEquation(x1, y1, x2, y2);

            for (let j = 0; j < ques.length; j++) {
                if (i !== j && valuesAreCircle(ques[j])) {
                    const circleValues = ques[j].split(',').map(Number);
                    const [cx, cy, r] = circleValues;

                    const intersections = findIntersection(lineEq, cx, cy, r);

                    for (const intersection of intersections) {
                        const { x, y } = intersection;
                        if (!isNaN(x) && !isNaN(y) && !pointExists(points, x, y) && isInsideCanvas(x, y) && isOnLineSegment(x, y, x1, y1, x2, y2)) {
                            points.push(`${x},${y}`);
                        }
                    }
                } else if (i !== j && valuesAreLineSegment(ques[j])) {
                    const otherLineValues = ques[j].split(',').map(Number);
                    const [otherX1, otherY1, otherX2, otherY2] = otherLineValues;
                    const otherLineEq = findLineEquation(otherX1, otherY1, otherX2, otherY2);
                    const intersection = findLineIntersection(lineEq, otherLineEq);

                    if (intersection) {
                        const { x, y } = intersection;
                        if (!isNaN(x) && !isNaN(y) && !pointExists(points, x, y) && isInsideCanvas(x, y) && isOnLineSegment(x, y, x1, y1, x2, y2) && isOnLineSegment(x, y, otherX1, otherY1, otherX2, otherY2)) {
                            points.push(`${x},${y}`);
                        }
                    }
                } else if (i !== j && valuesAreCircle(ques[j])) {
                    const otherCircleValues = ques[j].split(',').map(Number);
                    const [otherCx, otherCy, otherR] = otherCircleValues;
                    const intersections = findIntersectionLineCircle(lineEq, otherCx, otherCy, otherR);

                    for (const intersection of intersections) {
                        const { x, y } = intersection;
                        if (!isNaN(x) && !isNaN(y) && !pointExists(points, x, y) && isInsideCanvas(x, y)) {
                            points.push(`${x},${y}`);
                        }
                    }
                }
            }
        } else {
            throw new Error(`Invalid input. Expecting either 3 or 4 comma-separated values. Received: "${ques[i]}"`);
        }
    }

    return points;
}


function valuesAreCircle(values) {
    return values.split(',').map(Number).length === 3;
}

function valuesAreLineSegment(values) {
    return values.split(',').map(Number).length === 4;
}

let points = calculateIntersections(ques);


for (const item of ques) {
    const values = item.split(',').map(Number);

    if (values.length === 3) {
        // Draw a circle
        const [x, y, r] = values;
        drawCircle(x, y, r);
    } else if (values.length === 4) {
        // Draw lines
        const [x1, y1, x2, y2] = values;

        drawLineFunction(x1, y1, x2, y2);
        drawLineSegment(x1, y1, x2, y2);
    } else if (values.length === 2) {
        // Draw a point
        const [x, y] = values;
        drawPoint(x, y);
    } 
}

function drawCircle(x, y, r) {
    ctx.beginPath();
    ctx.arc(x, y, r, 0, 2 * Math.PI);
    ctx.strokeStyle = 'black';
    ctx.lineWidth = 1;
    ctx.stroke();
}

function drawLineSegment(x1, y1, x2, y2) {
    ctx.beginPath();
    ctx.moveTo(x1, y1);
    ctx.lineTo(x2, y2);
    ctx.strokeStyle = 'black';
    ctx.lineWidth = 1;
    ctx.stroke();
}

function drawLineFunction(x1, y1, x2, y2) {
    const m = (y2 - y1) / (x2 - x1);
    const b = y1 - m * x1;

    ctx.beginPath();
    ctx.moveTo(0, m * 0 + b);
    ctx.lineTo(700, m * 700 + b);
    ctx.strokeStyle = 'gray';
    ctx.lineWidth = 1;
    ctx.stroke();
}


// Drawing functions
function drawCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    for (const item of ques) {
        const values = item.split(',').map(Number);

        if (values.length === 3) {
            // Draw a circle
            const [x, y, r] = values;
            drawCircle(x, y, r);
        } else if (values.length === 4) {
            // Draw lines
            const [x1, y1, x2, y2] = values;

            drawLineFunction(x1, y1, x2, y2);
            drawLineSegment(x1, y1, x2, y2);
        }
    }

    for (const point of points) {
        const [x, y] = point.split(',').map(Number);
        drawEmptyCircle(x, y, 5);
    }
}

function drawEmptyCircle(x, y, r) {
    ctx.beginPath();
    ctx.arc(x, y, r, 0, 2 * Math.PI);
    ctx.strokeStyle = 'black';
    ctx.lineWidth = 1;
    ctx.stroke();
}

// Mouse event handling
let dragging = false;
let startPoint = null;
let endPoint = null;

canvas.addEventListener('mousedown', (event) => {
    const rect = canvas.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    startPoint = findClosestPoint(x, y, points);

    if (startPoint) {
        dragging = true;
    }
});

canvas.addEventListener('mousemove', (event) => {
    if (!dragging) {
        return;
    }

    const rect = canvas.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    endPoint = { x, y };

    drawCanvas();
    drawLineSegment(...startPoint, x, y);
});

canvas.addEventListener('mouseup', () => {
    if (!dragging) {
        return;
    }

    dragging = false;

  const endPointStr = findClosestPoint(endPoint.x, endPoint.y, points);
    if (endPointStr) {
        const [x1, y1] = startPoint;
        const [x2, y2] = endPointStr.map(Number);

        ques.push(`${x1},${y1},${x2},${y2}`);

        points = calculateIntersections(ques);
    }
    
    endPoint = null;

    drawCanvas();
});

function findClosestPoint(x, y, points) {
    let minDistance = Infinity;
    let closestPoint = null;

    for (const point of points) {
        const [px, py] = point.split(',').map(Number);
        const distance = Math.sqrt((px - x) * (px - x) + (py - y) * (py - y));

        if (distance < minDistance && distance <= 20) {
            minDistance = distance;
            closestPoint = [px, py];
        }
    }

    return closestPoint;
}

drawCanvas();

</script>



<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>

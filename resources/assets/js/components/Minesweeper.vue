<template>
    <div id='minesweeper' class='text-center'>
        <h3 v-once>{{message}}</h3>
        <hr>
        <div v-if='!game.started'>
            <div>
                <h4>Size: </h4>
                <select v-model='board.rowCount'>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                </select>
                <h4>Bombs: </h4>
                <select v-model='board.bombCount'>
                    <option>12</option>
                    <option>18</option>
                    <option>24</option>
                </select>
            </div>
            <br>           
            <button @click='startGame()' class='btn btn-dark'>Play</button>
        </div>
        <table id='mineTable' class='mx-auto' style='table-layout:fixed'></table>
        <button v-if='game.started' @click='openAllCells()' class='btn btn-dark m-2'>Cheat</button>
        <h3 v-if='game.over'><br>{{game.endStatus}}</h3>
    </div>
</template>
<script>

class Cell {
    constructor() {
        this.label = '';
        this.color = 'blue';
        this.bgColor = 'whitesmoke';
        this.x = 0;
        this.y = 0;
        this.opened = false;
        this.flagged = false;
        this.bomb = false;
        this.neighbors = [];
        this.nearbyBombs = 0;
    }    
}

export default {
    data() {
        return {
            message: 'Made using Vue.js',
            game: {
                started: false,
                over: false,
                endStatus: ''
            },
            board: {
                // defaults
                rowCount: 10,   
                bombCount: 12,
                cellCount: 0,
                openedCells: 0,
                cells: [],
                bombs: [],
                cellSize: '46px' 
            }               
        }
    },
    methods: {
        startGame() {
            if (this.game.over) {
                this.resetGame();
            }
            this.game.started = true;
            this.drawBoard();       // draw the board
            this.addEventHandlers();// cell clicks
            this.pushCells();       // generate cells and fill the cell array
            this.generateBombs();   // turn X cells into bombs
            this.getStats();        // assign neighbours and get nearby bomb counts
            this.defaultStyle();    // style the board
        },
        resetGame() {
            document.getElementById('mineTable').innerHTML = '';
            this.game.over = false;
            this.board.cells = [];
            this.board.bombs = [];
            this.board.cellCount = Math.pow(this.board.rowCount, 2) - this.board.bombCount;
            this.board.openedCells = 0;
        },
        drawBoard() {
            const table = document.getElementById('mineTable');
            let size = this.board.rowCount; 
            for (let i = 0; i < size; i++) {
                let tr = document.createElement('tr');
                for (let j = 0; j < size; j++) {                    
                    let td = document.createElement('td');
                    td.id = i.toString() + '-' + j.toString();
                    td.innerHTML = '';
                    tr.appendChild(td);
                }
                table.appendChild(tr);                
            }
            this.setWidth(); // set constant cell size
        },
        setWidth() {
            const tdWidth = document.querySelector('td').offsetWidth.toString() + 'px';
            this.board.cellSize = tdWidth;
        },
        findCell(y, x) {
            return this.board.cells[y][x];
        },
        addEventHandlers() {
            // grab all td's and attach left/right click handlers
            let td = document.getElementsByTagName('td');
            for (let i = 0, n = td.length; i < n; i++) {
                let self = td[i];
                self.addEventListener('contextmenu', this.handleClick);
                self.addEventListener('click', this.handleClick);
            }
        },
        handleClick(e) {
            e.preventDefault();
            // get cell location
            let cellId = e.target.id.split('-');
            // find cell
            let cell = this.findCell(cellId[0],cellId[1]);
            // check which mouse btn was pressed
            if (e.which == 1) { // left
                if (!cell.opened) {
                    if (cell.bomb) {
                        this.styleCell(cell);
                        this.endGame('You lose!');
                    } else {
                        this.openCell(cell);                      
                    }
                }
            } else if (e.which == 3) { // right
                this.turnIntoFlag(cell);          
            }
        },
        pushCells() {
            let size = this.board.rowCount;
            for (let i = 0; i < size; i++) {
                let row = []; // turn board array into 2d array for easier traversing
                this.board.cells.push(row);
                for (let j = 0; j < size; j++) {
                    let cell = new Cell();
                    cell.y = i; //assign 'coordinates'
                    cell.x = j;
                    row.push(cell);
                }
            }
        },       
        defaultStyle() {
            let td = document.getElementsByTagName('td');
            for (let i = 0, n = td.length; i < n; i++) {
                td[i].style.height = this.board.cellSize;
                td[i].style.backgroundColor = 'gray';
            }
        },
        getNeighbors(cell) {
            let size = this.board.rowCount;
            let cells = this.board.cells;
            let tempArray = [];

            for (let i = cell.y - 1; i <= cell.y + 1; i++) {
                // if trying to check for cells outside the board
                if (i < 0 || i >= size) {
                    continue;
                }
                for (let j = cell.x - 1; j <= cell.x + 1; j++) {
                    // same as above
                    if (j < 0 || j >= size) {
                        continue;
                    }
                    // if checking itself 
                    if (j == cell.x && i == cell.y) {
                        continue;
                    }
                    tempArray.push(this.findCell(i, j));
                }
            }
            cell.neighbors = tempArray;
        },
        turnIntoFlag(cell) {
            if(!cell.opened) {
                cell.flagged = true;
                cell.label = '?';
                cell.color = 'red';
                cell.bgColor = 'whitesmoke';
                this.styleCell(cell);
            } else if (cell.flagged) { // if already flagged, back to default look
                cell.label = '';
                cell.color = 'blue';
                cell.bgColor = 'whitesmoke'
                this.styleCell(cell);
            } 
        },       
        turnIntoBomb(cell) {
            cell.bomb = true;
            cell.label = 'X';
            cell.color = 'black';
            cell.bgColor = 'red';
        },
        generateBombs() {
            let count = this.board.bombCount;
            let i = 0;
            while (i < count) {
                let x = Math.floor(Math.random() * this.board.rowCount);
                let y = Math.floor(Math.random() * this.board.rowCount);
                let randCell = this.board.cells[y][x];
                if (!randCell.bomb) {
                    this.turnIntoBomb(randCell);
                    this.board.bombs.push(randCell);                
                } else {
                    // if cell already is a bomb, find new random cell(s)
                    let isBomb = true;
                    while(isBomb) {
                        x = Math.floor(Math.random() * this.board.rowCount);
                        y = Math.floor(Math.random() * this.board.rowCount);
                        randCell = this.board.cells[y][x];
                        // if not a bomb, turn it into a bomb and exit the nested loop
                        if (!randCell.bomb) {
                            this.turnIntoBomb(randCell);
                            this.board.bombs.push(randCell);
                            isBomb = false;
                        }
                    }
                }
                i++;
            }
        },
        getBombCount(cell) {
            for (let i = 0, n = cell.neighbors.length; i < n; i++) {
                if (cell.neighbors[i].bomb) {
                    cell.nearbyBombs += 1;
                }
            }
            if (!cell.bomb) {
                cell.label = cell.nearbyBombs;
                cell.color = 'blue';
            }
        },
        getStats() {      
            let size = this.board.rowCount;
            for (let i = 0; i < size; i++) {
                for (let j = 0; j < size; j++) {
                    let cell = this.findCell(i, j);
                    this.getNeighbors(cell);
                    this.getBombCount(cell);
                }
            }
        },
        openCell(cell) {
            cell.opened = true;
            this.styleCell(cell);
            // if 0 nearby bombs, open all neighbor cells
            if (cell.nearbyBombs == 0) { 
                for (let i = 0, n = cell.neighbors.length; i < n; i++) {                 
                    if (!cell.neighbors[i].opened) {
                        this.openCell(cell.neighbors[i]);
                    }
                }
            }
            this.board.openedCells++;
            if (this.board.openedCells === this.board.cellCount) {
                this.endGame('You win!');
            }
        },       
        styleCell(cell) {
            let cellId = cell.y + '-' + cell.x;
            let tdToStyle = document.getElementById(cellId);
            tdToStyle.style.backgroundColor = cell.bgColor;
            tdToStyle.style.color = cell.color;
            tdToStyle.innerHTML = cell.label;
            tdToStyle.style.height = this.board.cellSize; // to keep constant cell size
        },
        openAllCells() {
            for (let y = 0; y < this.board.rowCount; y++) {
                for (let x = 0; x < this.board.rowCount; x++) {
                    this.openCell(this.findCell(y,x));
                }
            }
            this.endGame('You win by cheating!');
        },
        endGame(status) {
            this.game.endStatus = status;
            this.game.started = false;
            this.game.over = true;
        }
    },
    mounted: function() {
        this.$nextTick(function () {
            // do stuff
        });        
    } 
}
</script>
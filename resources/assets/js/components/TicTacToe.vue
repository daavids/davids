<template>
    <div id='ticTacToe' class='text-center'>
        <h3 v-once>{{message}}</h3>
        <hr>
        <div v-if='player.chosen==false'>
            <h4>Choose your symbol (X goes first)</h4>
            <button @click='chooseSymbol("X")' class='btn btn-dark mx-2'>X</button>
            <button @click='chooseSymbol("O")' class='btn btn-dark mx-2'>O</button>
        </div>
        <div v-if='game.turnCount < 9 && player.chosen && !game.endGame'>
            <h4>You chose: {{player.symbol}}</h4>
            <h4 v-if='player.symbol == game.turn'>Your turn!</h4>
            <h4 v-else>AI's turn!</h4>
        </div>
        <div v-if='game.endGame'>
            <h4>{{game.endMessage}}</h4>
            <button @click='restartGame()' class='btn btn-dark mx-2 restartBtn'>Play again</button>
        </div>
        <br>
        <div>
            <table class='gameTable mx-auto'>
                <tr id='tableRow'>
                    <td @click='tryTurn(0)'>{{game.board[0]}}</td>
                    <td @click='tryTurn(1)'>{{game.board[1]}}</td>
                    <td @click='tryTurn(2)'>{{game.board[2]}}</td>
                </tr>
                <tr>
                    <td @click='tryTurn(3)'>{{game.board[3]}}</td>
                    <td @click='tryTurn(4)'>{{game.board[4]}}</td>
                    <td @click='tryTurn(5)'>{{game.board[5]}}</td>
                </tr>
                <tr>
                    <td @click='tryTurn(6)'>{{game.board[6]}}</td>
                    <td @click='tryTurn(7)'>{{game.board[7]}}</td>
                    <td @click='tryTurn(8)'>{{game.board[8]}}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            message: 'Made using Vue.js',
            player: {
                chosen: false,
                symbol: ''
            },
            ai: {
                symbol: ''
            },
            game: {
                turn: 'X',
                turnCount: 0,
                board: ['', '', '',
                        '', '', '',
                        '', '', ''],
                endMessage: '',
                endGame: false
            }
        }
    },
    mounted: function() {
        this.$nextTick(function () {
            let width = document.getElementById('tableRow').offsetWidth/3;
            this.styleTable(width); 
        });        
    },
    methods: {
        chooseSymbol: function(symbol) {
            this.player.symbol = symbol;
            this.player.chosen = true;
            symbol == 'X' ? this.ai.symbol = 'O' : this.ai.symbol = 'X'; 
        },
        styleTable: function(height) {
            // make height match width
            // NOTE TO SELF - DONT MESS WITH <TD> HEIGHTS
            let realHeight = height.toString() + 'px';            
            for (let i = 0; i < 3; i++) {
                document.getElementsByTagName('tr')[i].style.height = realHeight;
            }            
        },
        tryTurn: function(cell) {
            if (!this.player.chosen) {
                alert('Choose your symbol first!'); 
            } else if (this.game.endGame) {
                alert('Game has ended already!');
            } else if (this.game.board[cell] == '') {
                this.game.board[cell] = this.game.turn;
                ++this.game.turnCount;
                this.checkResult(this.game.turn);
            } else {
                alert('Cell already filled, pick an empty one!');
            }
            
        },
        switchTurns: function() {
            this.game.turn == 'X' ? this.game.turn = 'O' : this.game.turn = 'X';
        },
        checkResult: function(symbol) {
            if (this.checkWinner(symbol)) {
                if (this.player.symbol == symbol) {
                    this.game.endMessage = 'You win!';
                } else {
                    this.game.endMessage = 'AI wins, better luck next time!';
                }
                this.game.endGame = true;
            } else {
                if (this.game.turnCount == 9) {
                    this.game.endMessage = 'Tie game!';
                    this.game.endGame = true;
                } else {
                    this.switchTurns();
                }
            }
        },
        checkWinner: function(symbol) {
            let i = this.game.board;
            // top horizontal
            if (i[0] == symbol && i[1] == symbol && i[2] == symbol) {
                return true;
            // middle horizontal
            } else if (i[3] == symbol && i[4] == symbol && i[5] == symbol) {
                return true;
            // bottom horizontal
            } else if (i[6] == symbol && i[7] == symbol && i[8] == symbol) {
                return true;
            // left vertical
            } else if (i[0] == symbol && i[3] == symbol && i[6] == symbol) {
                return true;
            // middle vertical
            } else if (i[1] == symbol && i[4] == symbol && i[7] == symbol) {
                return true;
            // right vertical
            } else if (i[2] == symbol && i[5] == symbol && i[8] == symbol) {
                return true;
            // sw<->ne diagonal 
            } else if (i[2] == symbol && i[4] == symbol && i[6] == symbol) {
                return true;
            // se<->nw diagonal
            } else if (i[0] == symbol && i[4] == symbol && i[8] == symbol) {
                return true;
            // no winner
            } else {
                return false;
            }
        },
        restartGame: function() {
            // reset everything to default
            this.player.symbol = '';
            this.player.chosen = false;
            this.ai.symbol = '';
            this.game.turn = 'X';
            this.game.turnCount = 0;
            this.game.endGame = false;
            this.game.endMessage = '';            
            this.game.board = ['', '', '',
                              '', '', '',
                              '', '', ''];
        }
    }    
}
</script>
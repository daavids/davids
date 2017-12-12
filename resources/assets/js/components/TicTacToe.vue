<template>
    <div id='game' class='text-center'>
        <h3 v-once>{{message}}</h3>
        <hr>
        <div v-if='player.chosen==false'>
            <h4>Choose your symbol (X goes first)</h4>
            <button @click='chooseSymbol("X")' class='btn btn-dark'>X</button>
            <button @click='chooseSymbol("O")' class='btn btn-dark'>O</button>
        </div>
        <h4 v-else>Good luck!</h4>
        <br>
        <div>
            <table class='gameTable mx-auto'>
                <tr id='tableRow'>
                    <td id='0'></td>
                    <td id='1'></td>
                    <td id='2'></td>
                </tr>
                <tr>
                    <td id='3'></td>
                    <td id='4'></td>
                    <td id='5'></td>
                </tr>
                <tr>
                    <td id='6'></td>
                    <td id='7'></td>
                    <td id='8'></td>
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
                turn: ''
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
        }
    }    
}
</script>
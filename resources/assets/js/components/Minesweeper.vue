<template>
    <div id='minesweeper' class='text-center'>
        <h3 v-once>{{message}}</h3>
        <hr>

    </div>
</template>
<script>
export default {
    data: function() {
        return {
            message: 'Made using Vue.js'
        }
    }
}
</script>
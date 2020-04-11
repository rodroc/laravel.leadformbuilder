<template>
    <div class="form-group">
        <label for="">labelName</label>
        <input type="text" class="form-control" placeholder="" v-bind="status">
    </div>
</template>

<script>
    export default {

        data:{
            status: 'Critical'
        },

        mounted() {
            console.log('Textbox mounted.')
        }
    }
</script>

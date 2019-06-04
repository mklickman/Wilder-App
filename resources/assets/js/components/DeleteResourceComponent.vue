<template>
    <form class="col" :action="route" method="POST">
        <input type="hidden" name="_token" value="">
        <input type="hidden" name="_method" value="DELETE">
        <input type="submit" class="btn btn-outline-danger btn-block" :value="buttonText">
    </form>
</template>

<script>
    export default {
        props: ['route', 'buttonText', 'method'],
        mounted() {
            console.log('Component mounted.');
        }
    }
</script>

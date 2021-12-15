<template>
    <div>
        <form>
            <label for="name">Name: </label><input type="text" id="name" name="name" >
            <label for="username">Username: </label><input type="text" id="username" name="username">
            <label for="email">Email: </label><input type="text" id="email" name="email">
            <label for="password">Password: </label><input type='password' id="password" name="password">
        </form>
    </div>
</template>
<script>

    export default {
        props: [],
    }
</script>

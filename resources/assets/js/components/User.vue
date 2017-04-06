<template>
    <tr>
        <td>{{user.id}}</td>
        <td>{{user.name}}</td>
        <td>{{user.email}}</td>
        <td class="text-right">
            <button v-on:click="$emit('delete-user', user)" class="btn btn-sm btn-danger">Delete</button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['user']
    }
</script>

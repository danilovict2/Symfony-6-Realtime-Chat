<template>
    <div class="chat-log">
        <chat-message></chat-message>
        <chat-message></chat-message>
        <chat-message></chat-message>
    </div>
</template>

<script setup>
import ChatMessage from './ChatMessage.vue';


</script>

<style>
.chat-log .chat-message:nth-child(even) {
    background-color: #ccc;
}

</style>
<template>
    <div class="chat-log">
        <chat-message v-for="message in messages" :message="message.message" :user="message.user"></chat-message>
    </div>
</template>

<script setup>
import ChatMessage from './ChatMessage.vue';

defineProps({
    messages: Array
});

</script>

<style>
.chat-log .chat-message:nth-child(even) {
    background-color: #ccc;
}

</style>
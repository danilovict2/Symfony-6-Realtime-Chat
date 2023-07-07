<template>
    <div class="chat-message">
        <p>{{ message.message }}</p>
        <small>{{ message.sender.name }}</small>
    </div>
</template>

<script setup>

defineProps({
    message: Object
})

</script>

<style>
.chat-message {
    padding: 1rem;
}

.chat-message > p {
    margin-bottom: .5rem;
}
</style>
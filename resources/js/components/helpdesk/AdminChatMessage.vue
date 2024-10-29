<template>
    <div :class="['mb-4', message.is_from_user ? 'text-left' : 'text-right']">
        <div
            :class="[
                'inline-block px-3 py-1.5 rounded-xl text-sm',
                message.is_from_user
                    ? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200'
                    : 'bg-brand-500 text-white',
            ]"
        >
            {{ message.content }}
        </div>
        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            {{ formatDate(message.created_at) }}
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "AdminChatMessage",
    props: {
        message: {
            type: Object,
            required: true,
        },
    },
    methods: {
        formatDate(dateString) {
            return moment(dateString).fromNow();
        },
    },
};
</script>

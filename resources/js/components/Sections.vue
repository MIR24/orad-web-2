<template>
    <div class="sections-bar">
        <ul>
            <li v-on:click="setTab(index)" :class="section.id === current.id ? 'current' : ''" v-for="(section, index) in sections">
                {{ section.title }}
            </li>
        </ul>
    <div class="bottom"></div>
    </div>
</template>

<script>
    export default {
        props: ['sections', 'current', 'lal'],
        methods: {
            setTab(index) {
                this.$emit('tabSelected', index);
            },
        },
        mounted() {
            console.log('Sections component mounted.')
        }
    }
</script>
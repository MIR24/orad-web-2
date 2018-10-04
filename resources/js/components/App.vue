<template>
    <div>
        <sections/>
        <mobile-sections/>
        <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <div class="container">
                    {{content}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                content: 'this is content'
            };
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

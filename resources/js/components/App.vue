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
                sections: [
                    {id:1, title:'Топы', component: 'Tops'},
                    {id:2, title:'Newsbar', component: 'Newsbar'},
                    {id:3, title:'Срочно', component: 'Urgent'},
                    {id:4, title:'Срочно (орбиты)', component: 'UrgentOrbit'},
                    {id:5, title:'Бегущая строка', component: 'Ticker'},
                    {id:6, title:'Фото', component: 'Photo'},
                    {id:6, title:'Промо', component: 'Promo'},
                    {id:6, title:'Курс валют', component: 'Currency'},
                    {id:6, title:'Авторизация', component: 'Auth'},
                ],
                current: this.sections[0],
            };
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

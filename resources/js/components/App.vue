<template>
    <div>
        <sections :sections="sections" :current="current" v-on:tabSelected="setTab"/>
        <!--<mobile-sections/>-->
        <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <div class="container">
                    <component :is="current.component"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created () {
            this.sections = [
                {id:1, title:'Топы', component: 'Tops'},
                {id:2, title:'Newsbar', component: 'Newsbar'},
                {id:3, title:'Срочно', component: 'Urgent'},
                {id:4, title:'Срочно (орбиты)', component: 'UrgentOrbit'},
                {id:5, title:'Бегущая строка', component: 'Ticker'},
                {id:6, title:'Фото', component: 'Photo'},
                {id:7, title:'Промо', component: 'Promo'},
                {id:8, title:'Курс валют', component: 'Currency'},
            ];
            this.current = this.sections[0];

        },
        data() {
            return {
                sections: [],
                current: null
            }
        },
        methods: {
            setTab(index) {
                this.current = this.sections[index];
            }
        }
    }
</script>

<template>
    <div class="content">
        <div class="content-loader" v-if="loading">
            <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
        </div>
        <div v-else class="m-form m-form--fit m-form--label-align-right">
            <div class="m-portlet__body">
                <div class="entity-block orbits">
                    <div class="input-group">
                        <input type="text" class="form-control m-input" v-model="query" placeholder="Введите текст">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle promo" v-on:click="open" type="button">
                                {{filter || 'Все категории'}}
                            </button>
                            <div v-if="opened" class="dropdown-menu">
                                <a class="dropdown-item" :key="index" v-for="(item, index) in list" v-on:click="select(item.title)" href="#">{{item.title}}</a>
                            </div>
                        </div>
                        <div class="input-group-append search" v-on:click="search"><span class="input-group-text">Найти</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const list = [
        {title: 'Все категории'},
        {title: 'Сериал'},
        {title: 'Художественный фильм'},
        {title: 'Документальный фильм'},
        {title: 'Программа'},
        {title: 'Ток-шоу'},
        {title: 'Мюзикл'},
        {title: 'Мультфильм'},
        {title: 'Концерт'},
        {title: 'Спектакль'},
        {title: 'Н/д'},
    ];
    export default {

        data() {
            return {
                query: '',
                filter: '',
                loading: true,
                opened: false,
                list,
            };
        },
        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                setTimeout(() => {
                    this.loading = false;
                }, 500);
            },
            open() {
                this.opened = !this.opened;
            },
            select(value) {
                this.opened = false;
                this.filter = value;
            },
            submit() {
                console.log(this.records);
            },
            search() {
                alert(this.query);
            },
        }
    }
</script>

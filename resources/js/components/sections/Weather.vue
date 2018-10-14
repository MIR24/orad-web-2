<template>
    <div class="content">
        <div class="content-loader" v-if="loading">
            <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
        </div>
        <div v-else class="m-form m-form--fit m-form--label-align-right">
            <div class="m-portlet__body">
                <div class="inner-wrap">
                    <div class="entity-block no-back orbits" :key="index" v-for="(row, index) in records">
                        <div class="input-group">
                            <input type="text" class="form-control m-input" v-model="row.name" placeholder="Введите текст"/>
                            <input type="text" class="form-control m-input" v-model="row.day_temp" placeholder="Введите текст"/>
                            <input type="text" class="form-control m-input" v-model="row.night_temp" placeholder="Введите текст"/>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle promo" v-on:click="open" type="button">
                                    {{row.type.title}}
                                </button>
                                <div v-if="opened === index" class="dropdown-menu">
                                    <a class="dropdown-item" :key="index" v-for="(item, index) in types" v-on:click="select(index, item)" href="#">{{item.title}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const types = [
        {id:1, title:'ясно', icon: 'df'},
        {id:2, title:'переменная облачность', icon: 'df'},
        {id:3, title:'облачно', icon: 'df'},
        {id:4, title:'дождь', icon: 'df'},
        {id:5, title:'снег', icon: 'df'},
        {id:6, title:'гроза', icon: 'df'},
    ];
    const mock = [
        {id:1, name: 'Алматы', day_temp:22, night_temp:-10, type: {id:1, title:'ясно', icon: 'df'}},
        {id:2, name: 'Астана', day_temp:22, night_temp:-10,  type: {id:3, title:'облачно', icon: 'df'}},
        {id:3, name: 'Баку', day_temp:22, night_temp:-10,  type: {id:2, title:'переменная облачность', icon: 'df'}},
        {id:4, name: 'Барнаул', day_temp:22, night_temp:-10,  type: {id:1, title:'ясно', icon: 'df'}},
        {id:5, name: 'Бишкек', day_temp:22, night_temp:-10,  type: {id:1, title:'ясно', icon: 'df'}},
        {id:6, name: 'Владивосток', day_temp:22, night_temp:-10, type: {id:4, title:'дождь', icon: 'df'}},
        {id:7, name: 'Волгоград', day_temp:22, night_temp:-10, type: {id:5, title:'снег', icon: 'df'}},
        {id:8, name: 'Воронеж', day_temp:22, night_temp:-10, type: {id:1, title:'ясно', icon: 'df'}},
        {id:9, name: 'Душанбе', day_temp:22, night_temp:-10, type: {id:6, title:'гроза', icon: 'df'}},
        {id:10, name: 'Екатеринбург', day_temp:22, night_temp:-10, type: {id:1, title:'ясно', icon: 'df'}},
        {id:11, name: 'Ереван', day_temp:22, night_temp:-10, type: {id:1, title:'ясно', icon: 'df'}},
        {id:12, name: 'Ижевск', day_temp:22, night_temp:-10, type: {id:5, title:'снег', icon: 'df'}},
        {id:13, name: 'Иркутск', day_temp:22, night_temp:-10, type: {id:5, title:'снег', icon: 'df'}},
        {id:14, name: 'Казань', day_temp:22, night_temp:-10, type: {id:1, title:'ясно', icon: 'df'}},
        {id:15, name: 'Кемерово', day_temp:22, night_temp:-10, type: {id:1, title:'ясно', icon: 'df'}},
        {id:16, name: 'Кишинев', day_temp:22, night_temp:-10, type: {id:1, title:'ясно', icon: 'df'}},
        {id:17, name: 'Краснодар', day_temp:22, night_temp:-10, type: {id:4, title:'дождь', icon: 'df'}},
        {id:18, name: 'Красноярск', day_temp:22, night_temp:-10, type: {id:1, title:'ясно', icon: 'df'}},
        {id:19, name: 'Минск', day_temp:22, night_temp:-10, type: {id:1, title:'ясно', icon: 'df'}},
        {id:20, name: 'Москва', day_temp:22, night_temp:-10, type: {id:1, title:'ясно', icon: 'df'}},
    ];

    export default {
        data() {
            return {
                records: [],
                loading: true,
                opened: 0,
            };
        },
        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                setTimeout(() => {
                    this.records = mock.slice();
                    this.loading = false;
                }, 500);
            },
            addRecord() {
                this.records.push({title:'', text:''});
            },
            open() {
                this.opened = 0;
            },
            select(index, obj) {
                this.records[index] = obj;
            },
            submit() {
                console.log(this.records);
            }
        }
    }
</script>

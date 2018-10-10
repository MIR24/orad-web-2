<template>
    <div class="content">
        <div class="content-loader" v-if="loading">
            <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
        </div>
        <div v-else class="m-form m-form--fit m-form--label-align-right">
            <div class="m-portlet__body">
                <div class="currency-wrap">
                    <div class="entity-block currencies orbits" :key="l_index" v-for="(left, l_index) in currencies">
                        <div class="input-group" :key="index" v-for="(right, index) in left">
                            <div class="input-group-append"><span class="input-group-text">{{l_index}}</span></div>
                            <div class="input-group-append" v-model="types[right.status]" @click="nextStat(right)"><span :class="'input-group-text trend '+right.status">{{types[right.status]}}</span></div>
                            <input type="text" class="form-control m-input" v-model="right.value" placeholder="Введите текст"/>
                            <div class="input-group-append"><span class="input-group-text">{{right.name}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <button v-on:click="submit" class="btn btn-success btn-submit">Сохранить</button>
        </div>
    </div>
</template>

<script>
    const curs = {
        usd: [
            {status: 'asc', name: 'azn', value: 22.32},
            {status: 'desc', name: 'amd', value: 14.89},
            {status: 'asc', name: 'byr', value: 12.12},
            {status: 'desc', name: 'gel', value: 15.28},
            {status: 'desc', name: 'kzt', value: 18.88},
            {status: 'stab', name: 'kgs', value: 17.32},
            {status: 'asc', name: 'mdl', value: 18.43},
            {status: 'asc', name: 'uzs', value: 11.44},
            {status: 'stab', name: 'rub', value: 12.87},
        ],
        eur: [
            {status: 'asc', name: 'rub', value: 10},
        ],
        byr: [
            {status: 'asc', name: 'byr', value: 10},
        ]
    };
    export default {
        data() {
            return {
                loading: true,
                currencies: null,
                types: {
                    asc : '↗',
                    stab: '→',
                    desc: '↘',
                }
            };
        },
        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                setTimeout(() => {
                    this.currencies = Object.assign({}, curs);
                    this.loading = false;
                }, 500);
            },
            submit() {
                console.log(this.currencies);
            },
            nextStat(row) {
                let keys = Object.keys(this.types);
                    let cur_index = keys.indexOf(row.status),
                    nextkey = ++cur_index % 3;
                    row.status = keys[nextkey];
            }
        }
    }
</script>

<template>
    <div class="content">
        <div class="content-loader" v-if="loading">
            <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
        </div>
        <div v-else class="m-form m-form--fit m-form--label-align-right">
            <div v-if="records.length > 0" class="m-portlet__body">
                <div class="entity-block orbits">
                    <div class="input-group" :key="index" v-for="(record, index) in records">
                        <input type="text" class="form-control m-input" v-model="record.title" placeholder="Введите текст">
                        <div class="input-group-append"><span class="input-group-text">{{record.title}}</span></div>
                    </div>
                </div>
            </div>
            <div v-else class="no-records">
                Нет записей
            </div>
            <button v-on:click="submit" class="btn btn-success btn-submit">Сохранить</button>
        </div>
    </div>
</template>

<script>
    const records = [
        {id:1, title:'Мир24', text:'123'},
        {id:2, title:'Мир+0', text:'123'},
        {id:3, title:'Мир3PR', text:'123'},
        {id:4, title:'Мир+2', text:'123'},
        {id:5, title:'Мир+7', text:'123'},
        {id:6, title:'МирHD', text:'123'},
        {id:7, title:'Мир Беларусь', text:'123'},
    ];
    export default {
        data() {
            return {
                records: [],
                loading: true,
            };
        },
        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                setTimeout(() => {
                    this.records = records.slice();
                    this.loading = false;
                }, 500);
            },
            addRecord() {
                this.records.push({title:'', text:''});
            },
            removeRecord(index) {
                this.records.splice(index, 1);
            },
            submit() {
                console.log(this.records);
            }
        }
    }
</script>

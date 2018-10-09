<template>
    <div class="content">
        <div class="content-loader" v-if="loading">
            <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
        </div>
        <div v-else class="m-form m-form--fit m-form--label-align-right">
            <div v-if="records.length > 0" class="m-portlet__body">
                <div class="entity-block" :key="index" v-for="(record, index) in records">
                    <button type="button" v-on:click="removeRecord(index)" class="btn btn-danger m-btn m-btn--custom m-btn--bolder m-btn--uppercase delete-block">Удалить</button>
                    <span>{{record.id ? 'id: '+record.id : 'Новый'}}</span>
                    <div class="form-group m-form__group">
                        <label for="title">Заголовок</label>
                        <input type="text" v-model="record.title" class="form-control m-input" id="title" aria-describedby="emailHelp" placeholder="Заголовок">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="text">Текст</label>
                        <textarea v-model="record.text"  placeholder="Текст" class="form-control m-input" id="text" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div v-else class="no-records">
                Нет записей
            </div>
            <button v-on:click="addRecord" class="btn btn-primary">+ Добавить топ</button>
            <button v-on:click="submit" class="btn btn-success btn-submit">Сохранить</button>
        </div>

    </div>
</template>

<script>
    const records = [
        {id:1, title:'lorem ipsum 1', text:'Dolor sit amet sdlgflsjdg safjdlaskdf aslkdfj;askj;al sdk adf askdjf ;alskdfj a;lsdkf '},
        {id:2, title:'lorem ipsum 2', text:'Dolor sit amet sdlgflsjdg safjdlaskdf aslkdfj;askj;al sdk adf askdjf ;alskdfj a;lsdkf '},
        {id:3, title:'lorem ipsum 3', text:'Dolor sit amet sdlgflsjdg safjdlaskdf aslkdfj;askj;al sdk adf askdjf ;alskdfj a;lsdkf '},
        {id:4, title:'lorem ipsum 4', text:'Dolor sit amet sdlgflsjdg safjdlaskdf aslkdfj;askj;al sdk adf askdjf ;alskdfj a;lsdkf '},
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

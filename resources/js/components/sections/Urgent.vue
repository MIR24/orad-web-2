<template>
    <div class="content">
        <div class="content-loader" v-if="loading">
            <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
        </div>
        <div v-else class="m-form m-form--fit m-form--label-align-right">
            <div class="alert m-alert m-alert--default" role="alert">
            <h2>Порядок работы со срочной новостью</h2>
            Вкладка 1 и Вкладка 2 используется для наполнения срочной новости двойного newsbar. В поле заголовка пишется тема. Топы срочной новости пишутся в поле ниже построчно.
            Для срочной новости в одну строку используются топы только из 1 вкладки. Они записываются так же построчно.
            После того как вы заполнили и сохранили топы нужно позвонить в аппаратную (Вн. Номер 310), и сказать, чтобы срочную новость расставили в эфирную сетку, назвать орбиты на которых должна выходить срочная новость, и время окончания ее выдачи – если известно.
            </div>
            <div v-if="records.length > 0" class="m-portlet__body">
                <div class="entity-block" :key="index" v-for="(record, index) in records">
                    <button type="button" v-on:click="removeRecord(index)" class="btn btn-danger m-btn m-btn--custom m-btn--bolder m-btn--uppercase delete-block">Удалить</button>
                    <span>{{record.id ? 'id: '+record.id : 'Новая'}}</span>
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input type="text" v-model="record.title" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Заголовок">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleTextarea">Текст</label>
                        <textarea v-model="record.text"  placeholder="Текст" class="form-control m-input" id="exampleTextarea" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div v-else class="no-records">
                Нет записей
            </div>
            <button v-on:click="addRecord" class="btn btn-primary">+ Добавить новость</button>
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

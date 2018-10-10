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
            <ul class="nav nav-tabs  m-tabs-line" role="tablist">
                <li class="nav-item m-tabs__item" v-on:click="setVisibility('first')">
                    <a class="nav-link m-tabs__link active" data-toggle="tab" role="tab">Бар 1</a>
                </li>
                <li class="nav-item m-tabs__item" v-on:click="setVisibility('second')">
                    <a class="nav-link m-tabs__link" data-toggle="tab" role="tab">Бар 2</a>
                </li>
            </ul>
            <div class="m-portlet__body">
                <div v-if="visible === 'first'" class="entity-block">
                    <div class="form-group m-form__group">
                        <label for="title1">Заголовок</label>
                        <input type="text" v-model="records.first.title" class="form-control m-input" id="title1" placeholder="Введите текст">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="text1">Текст</label>
                        <textarea v-model="records.first.text"  placeholder="Введите текст" class="form-control m-input" id="text1" rows="3"></textarea>
                    </div>
                </div>
                <div v-if="visible === 'second'" class="entity-block">
                    <div class="form-group m-form__group">
                        <label for="title2">Заголовок</label>
                        <input type="text" v-model="records.second.title" class="form-control m-input" id="title2" placeholder="Введите текст">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="text2">Текст</label>
                        <textarea v-model="records.second.text"  placeholder="Введите текст" class="form-control m-input" id="text2" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <button v-on:click="submit" class="btn btn-success btn-submit">Сохранить</button>
        </div>
    </div>

</template>

<script>
    const records = {
        first: {id:1, title:'lorem ipsum 1', text:'Dolor sit amet sdlgflsjdg safjdlaskdf aslkdfj;askj;al sdk adf askdjf ;alskdfj a;lsdkf '},
        second: {id:2, title:'lorem ipsum 2', text:'Dolor sit amet sdlgflsjdg safjdlaskdf aslkdfj;askj;al sdk adf askdjf ;alskdfj a;lsdkf '},
    };
    export default {
        data() {
            return {
                visible: 'first',
                records: {},
                loading: true,
            };
        },
        created() {
            this.loadData();
        },

        methods: {
            setVisibility(tab) {
                this.visible = tab;
            },
            loadData() {
                setTimeout(() => {
                    this.records = Object.assign({}, records);
                    this.loading = false;
                }, 500);
            },
            submit() {
                console.log(this.records);
            }
        }
    }
</script>

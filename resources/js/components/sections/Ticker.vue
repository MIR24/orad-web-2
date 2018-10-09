<template>
    <div class="content n-bar">
        <div class="content-loader" v-if="loading">
            <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
        </div>
        <div v-else class="m-form m-form--fit m-form--label-align-right">
            <div class="m-portlet__body">
                <div class="entity-block newsbar">
                    <div class="form-group m-form__group">
                        <label for="advert">Анонс</label>
                        <textarea v-model="records.advert"  placeholder="Введите текст" class="form-control m-input" id="advert" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="entity-block newsbar">
                    <div class="form-group m-form__group">
                        <label for="broadcast">Прямая трансляция</label>
                        <textarea v-model="records.broadcast"  placeholder="Введите текст" class="form-control m-input" id="broadcast" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <button v-on:click="submit" class="btn btn-success btn-submit">Сохранить</button>
        </div>

    </div>
</template>

<script>
    const records = {
        advert: "УВАЖАЕМЫЕ ТЕЛЕЗРИТЕЛИ! В НАШЕЙ ПРОГРАММЕ ПРОИЗОШЛИ ИЗМЕНЕНИЯ. В 21.00 МСК СМОТРИТЕ НА НАШЕМ КАНАЛЕ ПРЕСС-КОНФЕРЕНЦИЮ ПРЕЗИДЕНТА БЕЛАРУСИ АЛЕКСАНДРА ЛУКАШЕНКО ДЛЯ ПРЕДСТАВИТЕЛЕЙ РОССИЙСКИХ РЕГИОНАЛЬНЫХ СРЕДСТВ МАССОВОЙ ИНФОРМАЦИИ. 123",
        broadcast: "ПРЯМО СЕЙЧАС # КУБА/САНТЬЯГО-ДЕ-КУБА ПОХОРОНЫ ФИДЕЛЯ КАСТРО. 1",
    };
    export default {
        data() {
            return {
                records: {
                    advert: '',
                    broadcast: '',
                },
                loading: true,
            };
        },
        created() {
            this.loadData();
        },

        methods: {
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

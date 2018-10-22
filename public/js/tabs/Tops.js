class Tops extends BaseTab {
    constructor () {
        super();
        this.url = '/test/tops';
    }

    makeTemplate (response) {
        this.template = Object.keys(response).map(key => {
            var text = Object.keys(response[key].releated).map(keyInner => (
                response[key].releated[keyInner].text
            )).join('');
            return `<div class="col-12 mb-5 p-5 bg-secondary">
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="form-group m-form__group">
                        <label for="title${key}">Заголовок</label>
                        <input value="${response[key].title}" type="title" class="form-control m-input m-input--air" id="title${key}" aria-describedby="emailHelp" placeholder="Заголовок">
                        <label for="textarea${key}">Текст</label>
                        <textarea class="form-control m-input m-input--air" id="textarea${key}" rows="3" placeholder="Текст">${text}</textarea>
                    </div>
                </form>
            </div>`
        }).join('');
    }
}
const ModalsConfig = {
    "default": {
        "loader": {
            "template": `<div class="blockUI" style="display:none"></div>
                <div class="blockUI blockOverlay" style="z-index: 10; border: none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(0, 0, 0); opacity: 0.1; cursor: wait; position: absolute;"></div>
                <div class="blockUI blockMsg blockElement" style="z-index: 1011; position: absolute; padding: 0px; margin: 0px; width: auto; top: 194.5px; left: 250px; text-align: center; color: rgb(0, 0, 0); border: 0px; cursor: wait;">
                    <div class="m-loader  m-loader--brand m-loader--lg"></div>
                </div>`,
            "jqClassName": ".blockUI",
        },
    },
    "edit-promo": {
        "modalTitle": "Редактировать промо",
        "enterEditBtn": "modal-enter-edit",
    },
    "create-promo": {
        "modalTitle": "Создать промо",
        "enterEditBtn": "modal-enter-create",
    },
    "edit-photoUpload": {
            "modalTitle": "Редактировать запись",
        "enterEditBtn": "modal-enter-edit",
    },
    "create-photoUpload": {
        "modalTitle": "Создать промо",
        "enterEditBtn": "modal-enter-create",
    },
    "confirmation-delete-model": {
        "message": `<div class="m-alert m-alert--icon alert alert-danger" role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-danger"></i>
                        </div>
                        <div class="m-alert__text">
                            <strong>Вы действительно хотите удалить?</strong>
                        </div>
                    </div>`,
        "okButton": "confirmation-modal-ok",
        "noButton": "confirmation-modal-no",
    },
    "confirmation-edit-next-model": {
        "message": `<div class="m-alert m-alert--icon alert alert-danger" role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-danger"></i>
                        </div>
                        <div class="m-alert__text">
                            <strong>Вы действительно хотите покинуть редактирование записи?</strong>
                            <br>
                            Изменения потеряются.
                        </div>
                    </div>`,
        "okButton": "confirmation-modal-ok",
        "noButton": "confirmation-modal-no",
    },
    "info-show-help-model": {
        "closeButton": "close",
    },
}
export default ModalsConfig
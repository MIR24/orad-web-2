import BaseExternalComponent from "../BaseClasses/BaseExternalComponent.js";
import { currentActive, csrf, toastrMessages } from "../Config/Constants.js";
import DropZoneConfig from "../Config/DropZoneConfig.js";

class DropZoneCustom extends BaseExternalComponent {
    constructor (id, type, value, configType, disabled) {
        super(id, type, false, disabled);
        this.value = value && value !== undefined && value !== null ? value : null;
        this.config = Object.assign({}, DropZoneConfig[configType], DropZoneConfig.default);
        this.options = Object.assign(this.options, {
            function: 'dropzone',
            options: {
                url: this.config.url,
                headers: {
                    'X-CSRF-Token': csrf
                },
                maxFiles: 1,
                addRemoveLinks: true,
                dictRemoveFile: 'Удалить',
                acceptedFiles: 'image/*',
                custom: {
                    id: '#' + this.id,
                    img: this.value ? {
                        id: 1,
                        url: this.value,
                        name: 'mockFile',
                    } : null,
                    modelId: this.modelId,
                    valueName: this.valueName,
                    updateEditState: function (path) {
                        if (currentActive.tab.currentTabClassVar) {
                            currentActive.tab.currentTabClassVar.updateEditState(this.modelId, this.valueName, path);
                        } else {
                            currentActive.tab.updateEditState(this.modelId, this.valueName, path);
                        }
                    }
                },
                init: function () {
                    if (this.options.custom.img) {
                        var mockFile = new File ([''], this.options.custom.img.url);
                        mockFile.accepted = true;
                        this.files.push(mockFile)
                        this.emit("addedfile", mockFile);
                        this.emit("thumbnail", mockFile, this.options.custom.img.url);
                        this.emit("complete", mockFile);
                        $(this.options.custom.id).children().last().children().first().children().first().css('zoom', 0.2);
                    }
                },
                success: function (file, response) {
                    this.options.custom.updateEditState(response.data.url);
                },
                removedfile: function (file) {
                    $(this.options.custom.id).children().last().children().first().children().first().removeAttr('style');
                    file.previewElement.remove();
                    this.options.custom.updateEditState(null);
                },
                maxfilesexceeded: function (file) {
                    toastr.error(toastrMessages.error.maxNumFiles)
                    this.removeFile(file)
                }
            },
        });
    }

    makeTemplate () {
        if (!this.disabled) {
            this.template = `<img src="${this.value}" class="img-thumbnail" alt="Фото не существует">`;
        } else {
            this.template = `<div id="${this.id}" class="m-dropzone dropzone dz-clickable">
                <div class="m-dropzone__msg dz-message needsclick">
                    <span>Перетащите сюда файл или нажмите, чтобы загрузить.</span>
                </div>
            </div>`;
        }
    }
}
export default DropZoneCustom
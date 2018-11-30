import BaseExternalComponent from "../BaseClasses/BaseExternalComponent.js";
import { currentActive, csrf, toasterMessages } from "../Config/Constants.js";
import Select2Config from "../Config/Select2Config.js";

class DropZoneCustom extends BaseExternalComponent {
    constructor (id, type, disabled, configType) {
        super(id, type);
        this.options = Object.assign(this.options, {
            function: 'dropzone',
            options: {
                url: '/test/uploadImg',
                headers: {
                    'X-CSRF-Token': csrf
                },
                maxFiles: 1,
                addRemoveLinks: true,
                dictRemoveFile: 'Удалить',
                custom: {
                    img: {
                        id: 1,
                        url: '/svg/403.svg',
                        name: 'test',
                    },
                },
                init: function () {
                    var mockFile = {
                        name: this.options.customImgUrl,
                        size: false,
                    };

                    if (this.options.custom.img) {
                        mockFile = new File ([''], this.options.custom.img.url);
                        mockFile.accepted = true;
                        this.files.push(mockFile)
                        this.emit("addedfile", mockFile);
                        this.emit("thumbnail", mockFile, this.options.custom.img.url);
                        this.emit("complete", mockFile);
                    }
                },
                complete: function (file) {
                    console.log(this, file, currentActive);
                },
                removedfile: function (file) {
                    file.previewElement.remove();
                },
                maxfilesexceeded: function (file) {
                    toastr.error(toasterMessages.error.maxNumFiles)
                    this.removeFile(file)
                }
            },
        });
    }

    makeTemplate () {
        this.template = `<div id="${this.id}" class="m-dropzone dropzone dz-clickable">
            <div class="m-dropzone__msg dz-message needsclick">
                <span>Перетащите сюда файл или нажмите, чтобы загрузить.</span>
            </div>
        </div>`;
    }
}
export default DropZoneCustom
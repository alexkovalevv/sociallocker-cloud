<div class="form-group fields-editor">
    <label class="col-sm-2 control-label">
        Поля
        <div class="help-block">
            <strong>Подсказка:</strong> перетащите и отпустите, чтобы изменить порядок полей.
        </div>
    </label>
    <div class="control-group controls col-sm-10" id="opanda-fields-editor">
        <div class="opanda-error" style="display: none;">
            <i class="fa fa-exclamation-triangle"></i>
            <span class="opanda-error-text"></span>
        </div>

        <div class='table-wrap'>
            <table class="table opanda-table">
                <thead>
                    <tr>
                        <th class="opanda-gray opanda-drag"></th>
                        <th class="opanda-min opanda-icon">
                            <span>Иконка</span>
                        </th>
                        <th class="opanda-mapping">
                            <span>Назначение</span>
                            <i class="opanda-th-hint" data-popup-hint="#opanda-mapping-hint"></i>
                            <div id="opanda-mapping-hint" class="opanda-popup-hint">
                                Выберите, как будет работать это поле. Сопоставить его с одним из настраиваемых полей в База данных или использовать его как вспомогательный элемент для украшения вашей формы.
                            </div>
                        </th>
                        <th class="opanda-label">
                            <span>Имя Поля</span>
                            <i class="opanda-th-hint" data-popup-hint="#opanda-label-name"></i>
                            <div id="opanda-label-name" class="opanda-popup-hint">
                                 Имя поля используются в отчетах и деталях подписки.
                            </div>
                        </th>
                        <th class="opanda-min opanda-type">
                            <span>Тип поля</span>
                        </th>
                        <th class="opanda-min opanda-required">
                            <span>Обязательное?</span>
                        </th>
                        <th class="opanda-control opanda-min"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="opanda-item opanda-template">
                        <td class="opanda-gray opanda-drag"></td>
                        <td class="opanda-icon">
                            <select class="form-control opanda-icon-input"></select>
                        </td>
                        <td class="opanda-mapping">
                            <select class="form-control opanda-mapping-input opanda-lazy-select"></select>
                        </td>
                        <td class="opanda-label">
                            <input type="text" value="" class="form-control opanda-label-input" />
                        </td>
                        <td class="opanda-type">
                            <select class="form-control opanda-type-input opanda-lazy-select"></select>
                        </td>
                        <td class="opanda-required">
                            <input type="checkbox" class="opanda-required-input" />
                        </td>
                        <td class="opanda-control">
                            <a href="#" class="btn btn-default opanda-configure"><i class="fa fa-cog"></i></a>
                            <a href="#" class="btn btn-default opanda-remove"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class='opanda-options-templates'>

            <!-- Text Options -->

            <div class="opanda-options opanda-text-options">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Позиция иконки</label>
                    <div class="control-group col-sm-10">
                        <select class='form-control opanda-icon-position-input'>
                            <option value="right">Справа</option>
                            <option value="left">Слева</option>
                            <option value="none">По умолчанию</option>
                        <select>
                        <div class='help-block'>
                            Выберите положение иконки
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Заголовок</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-title-input' />
                        <div class='help-block'>
                            OНеобязательно. Название отображается над полем.
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Заглушка</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-placeholder-input' />
                        <div class='help-block'>
                            Необязательно. Заглушка в текстовом поле появляется, когда оно не заполнено.
                        </div>
                    </div>
                </div>

                <hr />

                <div class="form-group">
                    <label class="col-sm-2 control-label">Маска</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-mask-input' />
                        <input type='hidden' class='form-control opanda-mask-placeholder-input' />
                        <div class='help-block'>
                            Необязательно. <a href="http://support.onepress-media.com/input-masks/" target="_blank">задайте маску</a>, если необходимо, чтобы пользователи заполняли это поле в определенном формате.
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Это пароль</label>
                    <div class="control-group col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class='opanda-is-password-input'>
                                Отметьте, чтобы закрыть контент в этом поле символом "*"
                            </label>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="form-group">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="control-group col-sm-10">
                        <a href='#' class='btn btn-default opanda-hide'>Скрыть настройки</a>
                    </div>
                </div>

            </div>

            <!-- Integer  Options -->

            <div class="opanda-options opanda-integer-options">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Позиция иконки</label>
                    <div class="control-group col-sm-10">
                        <select class='form-control opanda-icon-position-input'>
                            <option value="right">Справа</option>
                            <option value="left">Слева</option>
                            <option value="none">По умолчанию</option>
                        <select>
                        <div class='help-block'>
                            Выберите положение иконки
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Title</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-title-input' />
                        <div class='help-block'>
                            Необязательный. Название отображается над полем.
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Placeholder</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-placeholder-input' />
                        <div class='help-block'>
                           Необязательно. Заглушка в текстовом поле появляется, когда оно не заполнено.
                        </div>
                    </div>
                </div>

                <hr />

                <div class="form-group">
                    <label class="col-sm-2 control-label">Min Value</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-min-input' />
                        <div class='help-block'>
                            Необязательно. Минимальное допустимое значение.
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Max Value</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-max-input' />
                        <div class='help-block'>
                            Необязательно. Максимально допустимое значение.
                        </div>
                    </div>
                </div>

                <hr />

                <div class="form-group">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="control-group col-sm-10">
                        <a href='#' class='btn btn-default opanda-hide'>Скрыть настройки</a>
                    </div>
                </div>

            </div>

            <!-- Dropdown Options -->

            <div class="opanda-options opanda-dropdown-options">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Title</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-title-input' />
                        <div class='help-block'>
                            Необязательно. Название отображается над полем.
                        </div>
                    </div>
                </div>

                <div class="form-group opanda-can-notice" style="display: none;">
                   <label class="col-sm-2 control-label"></label>
                   <div class="control-group col-sm-10">
                       <div class="alert alert-warning"></div>
                   </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Выбрать</label>
                    <div class="control-group col-sm-10 opanda-choices-editor">
                        <div class="opanda-choices-holder">

                        </div>

                        <div class="opanda-choice-item opanda-choice-item-template">
                            <input type='text' class='form-control opanda-choise-value-input' placeholder="Option Title" />
                            <a href="#" class="btn btn-default opanda-choice-remove"><i class="fa fa-times"></i></a>
                        </div>

                        <div class="opanda-choices-controls">
                            <a href="#" class="btn btn-default opanda-add-choice">
                                <i class="fa fa-plus"></i>
                                Добавить пункт
                            </a>
                        </div>
                    </div>

                </div>

                <hr />

                <div class="form-group">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="control-group col-sm-10">
                        <a href='#' class='btn btn-default opanda-hide'>Скрыть настройки</a>
                    </div>
                </div>

            </div>

            <!-- Hidden Options -->

            <div class="opanda-options opanda-hidden-options">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Value</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-value-input' />
                        <div class='help-block'>
                            Это значение будет сохраняться при отправке формы.
                        </div>
                    </div>
                </div>

                <hr />

                <div class="form-group">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="control-group col-sm-10">
                        <a href='#' class='btn btn-default opanda-hide'>Скрыть настройки</a>
                    </div>
                </div>

            </div>

            <!-- Checkbox Options -->

            <div class="opanda-options opanda-checkbox-options">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-description-input' />
                        <div class='help-block'>
                            Описание отображается рядом с флажком.
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Marked By Default</label>
                    <div class="control-group col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class='opanda-marked-by-default-input'>
                                Сделать этот флажок отмеченным по умолчанию
                            </label>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="form-group">
                    <label class="col-sm-2 control-label">Marked Value</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-marked-value-input' />
                        <div class='help-block'>
                            Это значение будет сохранено, если флажок отмечен.
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Unmarked Value</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-unmarked-value-input' />
                        <div class='help-block'>
                            Это значение будет сохранено, если флажок не отмечен.
                        </div>
                    </div>
                </div>

                <hr />

                <div class="form-group">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="control-group col-sm-10">
                        <a href='#' class='btn btn-default opanda-hide'>Скрыть настройки</a>
                    </div>
                </div>

            </div>

            <!-- Seprator Options -->

            <div class="opanda-options opanda-separator-options">
                Разделитель не имеет настроек.
            </div>

            <!-- Label Options -->
            <div class="opanda-options opanda-label-options">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Text</label>
                    <div class="control-group col-sm-10">
                        <input type='text' class='form-control opanda-text-input' />
                        <div class='help-block'>
                            Введите текст метки для отображения.
                        </div>
                    </div>
                </div>

                <hr />

                <div class="form-group">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="control-group col-sm-10">
                        <a href='#' class='btn btn-default opanda-hide'>Скрыть настройки</a>
                    </div>
                </div>

            </div>

            <!-- Html Options -->
            <div class="opanda-options opanda-html-options">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Html</label>
                    <div class="control-group col-sm-10">
                        <textarea class='form-control opanda-html-input'></textarea>
                        <div class='help-block'>
                            Вставьте html-код для отображения.
                        </div>
                    </div>
                </div>

                <hr />

                <div class="form-group">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="control-group col-sm-10">
                        <a href='#' class='btn btn-default opanda-hide'>Скрыть настройки</a>
                    </div>
                </div>

            </div>

            <!-- Unsupported Options -->
            <div class="opanda-options opanda-unsupported-options">
                К сожалению, плагин не поддерживает этот тип поля.
            </div>

        </div>

        <div class="opanda-controls">
            <a href="#" class="btn btn-default opanda-add-field">
                <i class="fa fa-plus"></i>
                Добавить поле
            </a>
        </div>
      </div>
</div>
<div class="bp-advanded-options">
	<div id="bp-advanced-visability-options">
		<div class="bp-editor-wrap">
			<div class="bp-when-empty">
				Вы еще не создали ни одного фильтра отображения замков, создайте их <a href="#" class="bp-add-filter">нажав сюда</a>.
				Фильтры нужны для того, чтобы более точно настроить показы замков для вашей аудитории. Вы можете настроить геолокацию или показывать замок только для лояльных пользователей.
				<strong>Если вы не хотите ограничивать показы замков, то пропустите этот пункт!</strong>
			</div>
			<div class="bp-filters"></div>
		</div>
		<div class="bp-filter bp-template">
			<div class="bp-point"></div>
			<div class="bp-head">
				<div class="bp-left">
					<span style="margin-left: 0px;"><strong>Тип:</strong></span>
					<select class="bp-filter-type form-control">
						<option value="showif">Показать замок, ЕСЛИ</option>
						<option value="hideif">Скрыть замок, ЕСЛИ</option>
					</select>
					<span>или</span>
					<a href="#" class="btn btn-default btn-remove-filter">Удалить условие</a>
				</div>
				<div class="bp-templates bp-right">
					<span><strong>Готовый шаблон:</strong></span>
					<select class="bp-select-template form-control">
						<option>- выбрать шаблон -</option>
						<?php foreach ( $templates as $template ) { ?>
						<option value="<?php echo $template['id'] ?>"><?php echo $template['title'] ?></option>
						<?php } ?>
					</select>
					<a href="#" class="btn btn-default bp-btn-apply-template">Применить</a>
				</div>
			</div>
			<div class="bp-box">
				<div class="bp-when-empty">
					Вы еще не создали условия отображения, создайте их <a href="#" class="bp-link-add">нажав сюда</a>.
				</div>
				<div class="bp-conditions"></div>
			</div>
		</div>
		<div class="bp-scope bp-template">
			<div class="bp-and"><span>И</span></div>
		</div>
		<div class="bp-condition bp-template">
			<div class="bp-or">или</div>
                <span class="bp-params">
                    <select class="bp-param-select form-control">
	                    <?php foreach( $filters as $filterParam ) { ?>
	                    <optgroup label="<?php echo $filterParam['title'] ?>">
		                    <?php foreach( $filterParam['items'] as $param ) { ?>
		                    <option value="<?php echo $param['id'] ?>">
			                    <?php echo $param['title'] ?>
		                    </option>
		                    <?php } ?>
	                    </optgroup>
	                    <?php } ?>
                    </select>
                    <i class="bp-hint">
	                    <span class="bp-hint-icon"></span>
	                    <span class="bp-hint-content"></span>
                    </i>
                </span>

                <span class="bp-operators">
                    <select class="bp-operator-select form-control">
	                    <option value="equals">Равно</option>
	                    <option value="notequal">Не равно</option>
	                    <option value="greater">Больше чем</option>
	                    <option value="less">Меньше чем</option>
	                    <option value="older">Старше чем</option>
	                    <option value="younger">Моложе чем</option>
	                    <option value="contains">Содержит</option>
	                    <option value="notcontain">Не содержит</option>
	                    <option value="between">Между</option>
                    </select>
                </span>
			<span class="bp-value"></span>

                <span class="bp-controls">
                    <div class="btn-group">
	                    <a href="#" class="btn btn-sm btn-default bp-btn-remove">-</a>
	                    <a href="#" class="btn btn-sm btn-default bp-btn-or">ИЛИ</a>
	                    <a href="#" class="btn btn-sm btn-default bp-btn-and">И</a>
                    </div>
                </span>
		</div>
		<div class="bp-date-control bp-relative bp-template">
			<div class="bp-inputs">
				<div class="bp-between-date">
					<div class="bp-absolute-date">
						<span class="bp-label"> from </span>

						<div class="bp-date-control bp-date-start" data-date="today">
							<input size="16" type="text" readonly="readonly" class="bp-date-value-start"
							       data-date="today"/>
							<i class="fa fa-calendar"></i>
						</div>
						<span class="bp-label"> to </span>

						<div class="bp-date-control bp-date-end" data-date="today">
							<input size="16" type="text" readonly="readonly" class="bp-date-value-end"
							       data-date="today"/>
							<i class="fa fa-calendar"></i>
						</div>
					</div>
					<div class="bp-relative-date">
						<span class="bp-label"> старше чем </span>
						<input type="text" class="bp-date-value bp-date-value-start" value="1"/>
						<select class="bp-date-start-units form-control">
							<option value="seconds">Секунда(ы)</option>
							<option value="minutes">Минута(ы)</option>
							<option value="hours">Час(сов)</option>
							<option value="days">День(дней)</option>
							<option value="weeks">Неделя(и)</option>
							<option value="months">Месяц(а)</option>
							<option value="years">Год(а)</option>
						</select>
						<span class="bp-label"> , моложе чем </span>
						<input type="text" class="bp-date-value bp-date-value-end" value="2"/>
						<select class="bp-date-end-units form-control">
							<option value="seconds">Секунда(ы)</option>
							<option value="minutes">Минута(ы)</option>
							<option value="hours">Час(сов)</option>
							<option value="days">День(дней)</option>
							<option value="weeks">Неделя(и)</option>
							<option value="months">Месяц(а)</option>
							<option value="years">Год(а)</option>
						</select>
					</div>
				</div>
				<div class="bp-solo-date">
					<div class="bp-absolute-date">
						<div class="bp-date-control" data-date="today">
							<input size="16" type="text" class="bp-date-value form-control" readonly="readonly" data-date="today"/>
							<i class="fa fa-calendar"></i>
						</div>
					</div>
					<div class="bp-relative-date">
						<input type="text" class="bp-date-value" value="1"/>
						<select class="bp-date-value-units form-control">
							<option value="seconds">Секунда(ы)</option>
							<option value="minutes">Минута(ы)</option>
							<option value="hours">Час(сов)</option>
							<option value="days">День(дней)</option>
							<option value="weeks">Неделя(и)</option>
							<option value="months">Месяц(а)</option>
							<option value="years">Год(а)</option>
						</select>
					</div>
				</div>
			</div>
			<div class="bp-switcher">
				<label><input type="radio" checked="checked" value="relative"/> <span>Относительно</span></label>
				<label><input type="radio" value="absolute"/> </span>Аблолютно</span></label>
			</div>
		</div>
		<div class="footer">
			<button type="button" class="btn btn-default bp-add-filter">+ Добавить фильтр</button>
		</div>
	</div>
	<?=$custom_fields->hidden($attribute);?>
</div>



<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'generate-form',
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	)); ?>
	<div class="row">
		<?php echo $form->error($model, 'number'); ?>
		<?php echo $form->labelEx($model, 'number'); ?>
		<?php echo $form->textField($model, 'number'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('OK'); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>
<div>
	<p>
		<?php if ($model->converted_number) echo $model->converted_number; ?>
	</p>
</div>
<script type="text/javascript">
	var numbers_words = [
		["один", "два", "три", "четыре", "пять", "шесть", "семь", "восемь", "девять"],
		["десять", "двадцать", "тридцать", "сорок", "пятьдесят", "шестьдесят", "семьдесят", "восемьдесят", "девяносто"],
		["сто", "двести", "триста", "четыреста", "пятьсот", "шестьсот", "семьсот", "восемьсот", "девятьсот"],
		["тысяча", "две тысячи", "три тысячи", "четыре тысячи", "пять тысяч", "шесть тысяч", "семь тысяч", "восемь тысяч", "девять тысяч"]
	];
	var teen_words = ["одиннадцать", "двенадцать", "тринадцать", "четырнадцать", "пятнадцать", "шестнадцать", "семнадцать", "восемнадцать", "девятнадцать"];
	function translate_numbers_to_words(number) {

		var result = [];

		if (number < 0 || number > 9999) {
			return "Неправильные входные данные";
		}

		var str = number.toString().split("").reverse().join("");

		for (var counter = 0; counter < str.length; counter++) {
			if (counter == 1 && str[counter] == "1") {
				result.pop();
				result.push(teen_words[str[counter - 1] - 1]);
			} else {
				result.push(numbers_words[counter][str[counter] - 1]);
			}

		}
		return result.reverse().join(" ");
	}
	console.log(translate_numbers_to_words(9520));
</script>
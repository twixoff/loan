<?php
use app\components\LoanTools;
?>

<h1 class="page-header">Займ #<?= $model->id ?></h1>

<table class="table">
    <tr>
        <th>Сумма займа</th>
        <td><?= number_format($model->sum, 0, '.', ' ') ?></td>
    </tr>
    <tr>
        <th><?= $model->getAttributeLabel('date') ?></th>
        <td><?= Yii::$app->formatter->asDate($model->date) ?></td>
    </tr>
    <tr>
        <th><?= $model->getAttributeLabel('period') ?></th>
        <td><?= $model->period ?> мес.</td>
    </tr>
    <tr>
        <th><?= $model->getAttributeLabel('percent') ?></th>
        <td><?= $model->percent ?> %</td>
    </tr>
</table>

<?php $data = json_decode($model->payments, true); ?>

<table class="table table-hover table-bordered">
    <tr>
        <th>Номер платежа</th>
        <th>Дата платежа</th>
        <th>Сумма платежа</th>
        <th>Сумма процентов</th>
        <th>Основной долг</th>
        <th>Остаток долга</th>
    </tr>
    <?php foreach($data as $month => $row) : ?>
        <tr>
            <td><?= $month ?></td>
            <td><?= date('d-m-y', strtotime($model->date. " + $month months")) ?></td>
            <td><?= number_format($row['sumPerMonth'], 2, '.', ' ') ?></td>
            <td><?= number_format($row['percentSumPerMonth'], 2, '.', ' ') ?></td>
            <td><?= number_format($row['sumForLoan'], 2, '.', ' ') ?></td>
            <td><?= number_format($row['loanRemainSum'], 2, '.', ' ') ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td></td>
        <td></td>
        <td style="font-weight: bold;"><?= number_format(array_sum(array_column($data, 'sumPerMonth')), 2, '.', ' ') ?></td>
        <td style="font-weight: bold;"><?= number_format(array_sum(array_column($data, 'percentSumPerMonth')), 2, '.', ' ') ?></td>
        <td style="font-weight: bold;"><?= number_format(array_sum(array_column($data, 'sumForLoan')), 2, '.', ' ') ?></td>
        <td></td>
    </tr>
</table>
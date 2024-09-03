<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acr Statuses'), ['controller' => 'AcrStatuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acr Status'), ['controller' => 'AcrStatuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Statuses'), ['controller' => 'AssessmentStatuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Status'), ['controller' => 'AssessmentStatuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Login History'), ['controller' => 'LoginHistory', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Login History'), ['controller' => 'LoginHistory', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['controller' => 'Questionnaires', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['controller' => 'Questionnaires', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Code') ?></th>
            <td><?= h($user->company_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Name') ?></th>
            <td><?= h($user->company_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position Title') ?></th>
            <td><?= h($user->position_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extension') ?></th>
            <td><?= h($user->extension) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Size') ?></th>
            <td><?= h($user->company_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Industry') ?></th>
            <td><?= h($user->industry) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department Size') ?></th>
            <td><?= h($user->department_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subscribed') ?></th>
            <td><?= h($user->subscribed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= h($user->photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Status') ?></th>
            <td><?= h($user->registration_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Assessments Status') ?></th>
            <td><?= h($user->assessments_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Source') ?></th>
            <td><?= h($user->source) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Id') ?></th>
            <td><?= $this->Number->format($user->company_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department Id') ?></th>
            <td><?= $this->Number->format($user->department_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reg Status Date') ?></th>
            <td><?= h($user->reg_status_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Token Expiry Date') ?></th>
            <td><?= h($user->token_expiry_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Reg Status Remarks') ?></h4>
        <?= $this->Text->autoParagraph(h($user->reg_status_remarks)); ?>
    </div>
    <div class="row">
        <h4><?= __('Password Reset Token') ?></h4>
        <?= $this->Text->autoParagraph(h($user->password_reset_token)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Acr Statuses') ?></h4>
        <?php if (!empty($user->acr_statuses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Assessment Control Requirement Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Status Log') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->acr_statuses as $acrStatuses): ?>
            <tr>
                <td><?= h($acrStatuses->id) ?></td>
                <td><?= h($acrStatuses->assessment_control_requirement_id) ?></td>
                <td><?= h($acrStatuses->user_id) ?></td>
                <td><?= h($acrStatuses->status) ?></td>
                <td><?= h($acrStatuses->status_log) ?></td>
                <td><?= h($acrStatuses->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AcrStatuses', 'action' => 'view', $acrStatuses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AcrStatuses', 'action' => 'edit', $acrStatuses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AcrStatuses', 'action' => 'delete', $acrStatuses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acrStatuses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Assessment Statuses') ?></h4>
        <?php if (!empty($user->assessment_statuses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Assessment Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Status Log') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->assessment_statuses as $assessmentStatuses): ?>
            <tr>
                <td><?= h($assessmentStatuses->id) ?></td>
                <td><?= h($assessmentStatuses->assessment_id) ?></td>
                <td><?= h($assessmentStatuses->user_id) ?></td>
                <td><?= h($assessmentStatuses->status) ?></td>
                <td><?= h($assessmentStatuses->status_log) ?></td>
                <td><?= h($assessmentStatuses->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AssessmentStatuses', 'action' => 'view', $assessmentStatuses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AssessmentStatuses', 'action' => 'edit', $assessmentStatuses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AssessmentStatuses', 'action' => 'delete', $assessmentStatuses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentStatuses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Login History') ?></h4>
        <?php if (!empty($user->login_history)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Log Time') ?></th>
                <th scope="col"><?= __('Ip Address') ?></th>
                <th scope="col"><?= __('Remarks') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->login_history as $loginHistory): ?>
            <tr>
                <td><?= h($loginHistory->id) ?></td>
                <td><?= h($loginHistory->user_id) ?></td>
                <td><?= h($loginHistory->log_time) ?></td>
                <td><?= h($loginHistory->ip_address) ?></td>
                <td><?= h($loginHistory->remarks) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LoginHistory', 'action' => 'view', $loginHistory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LoginHistory', 'action' => 'edit', $loginHistory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LoginHistory', 'action' => 'delete', $loginHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $loginHistory->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Questionnaires') ?></h4>
        <?php if (!empty($user->questionnaires)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Questions') ?></th>
                <th scope="col"><?= __('Evidence File') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->questionnaires as $questionnaires): ?>
            <tr>
                <td><?= h($questionnaires->id) ?></td>
                <td><?= h($questionnaires->user_id) ?></td>
                <td><?= h($questionnaires->name) ?></td>
                <td><?= h($questionnaires->questions) ?></td>
                <td><?= h($questionnaires->evidence_file) ?></td>
                <td><?= h($questionnaires->created) ?></td>
                <td><?= h($questionnaires->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Questionnaires', 'action' => 'view', $questionnaires->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Questionnaires', 'action' => 'edit', $questionnaires->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Questionnaires', 'action' => 'delete', $questionnaires->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionnaires->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

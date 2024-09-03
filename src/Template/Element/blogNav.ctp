<nav class="large-3 medium-4 columns" id="actions-sidebar">
<ul class="nav flex-column">
    <li class="nav-item">
        <?= $this->Html->link(__('All Categories'), ['controller' => 'Categories', 'action' => 'index'],['class'=>'nav-link']) ?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link(__('Add Category'), ['controller' => 'Categories', 'action' => 'add'],['class'=>'nav-link']) ?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link(__('All Authors'), ['controller' => 'Authors', 'action' => 'index'],['class'=>'nav-link']) ?>
    </li>
    <li class="nav-item"> 
        <?= $this->Html->link(__('Add Author'), ['controller' => 'Authors', 'action' => 'add'],['class'=>'nav-link']) ?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link(__('All Articles'), ['controller' => 'Articles','action' => 'index'],['class'=>'nav-link']) ?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link(__('Add Article'), ['controller' => 'Articles', 'action' => 'add'],['class'=>'nav-link']) ?>
    </li>
</ul> 
</nav>
<div class="row">
                     <div class="col-md-12">                        
                        <div class="sidebar-box-categories">
                            <h3 class="sidebar-heading-categories"><i class="fa fa-tags" aria-hidden="true"></i> Categories</h3>
                            <ul class="categories">
                            <?php foreach($categories as $category){
                                if(isset($cat)){
                                    if($cat == $category->name){
                                        $sclass = 'active';
                                    }else{
                                        $sclass = '';
                                    }
                                }
                                 
                                ?>
                                <li class="<?= !empty($sclass) ? $sclass: '' ?>"><?= $this->Html->link(__("$category->name"), ['action' => 'category', $category->slug],['class'=>' btn-custom']) ?></li>                                           
                                        <?php } ?>                               
                            </ul>
                         </div>
                     </div>
                  </div>
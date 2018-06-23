<div class="container">
    <?php foreach ($projectTree as $value) { if ($value['href'] == $this->router->getRewriteUri()) { ?>
        <h4 class="center-wrap">
            <pre><?= $value['name'] ?></pre>
        </h4>
    <?php } ?><?php } ?>

    <div class="row">
        <div class="col-md-4">
            <div class="text-center">
                <img class="rounded-circle" src="/main/img/slide-1.png" width="370" height="300">
            </div>
        </div>

    <div class="col-8">
        <br>
        <br>
        <ul class="list">
        <?php foreach ($projectTree as $field) { ?>
            <?php if ($field['href'] == $this->router->getRewriteUri()) { ?>
                <li><a href="<?= $field['href'] ?>" class="list-group-item-action list-group-item-primary"><?= $field['sname'] ?></a></li>
            <?php } else { ?>
            <li><a href="<?= $field['href'] ?>" class="list-group-item-action"><?= $field['sname'] ?></a></li>
            <?php } ?>
        <?php } ?>
        </ul>
    </div>
    </div>
</div>

<div class="modal fade" id="modalDynamicInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<hr>



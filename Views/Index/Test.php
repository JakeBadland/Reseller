<TABLE>
    <?php foreach ($orders as $key => $order): ?>

        <?php $back = ''; ?>

        <?php if (!$order->address || !$order->deliveryProvider) : ?>
            <?php $back = "style='background-color: red'"; ?>
        <?php endif ?>

        <?php if ($order->status == 'pending') : ?>
            <?php $back = "style='background-color: yellow'"; ?>
        <?php endif ?>

        <TR>
            <TD >
                <BUTTON <?=$back?> class="copy p5">COPY</BUTTON>
            </TD>
            <TD style="background-color: RGB(<?=$color?>)" class="shopName p5"><?= $order->store ?></TD>
            <TD class="p5"><?= $order->name ?></TD>
            <TD class="p5"><?= $order->phone ?></TD>
            <TD class="p5 tac"><?= $order->address ?></TD>
            <TD class="p5"><?= $order->date ?></TD>
            <TD class="p5"><?= $order->id ?></TD>
            <TD class="p5"><?= $order->price ?></TD>
            <TD class="p5"><?= $order->deliveryProvider ?></TD>
            <TD class="p5"><?= $order->description ?></TD>
            <TD style="background-color: rgb(255,0,255)"><?= $order->purchaseType ?></TD>
            <!--<TD><?= strtoupper($order->status) ?></TD>-->
        </TR>

    <?php endforeach; ?>
</TABLE>

<script>
    $(document).ready(function () {

        $('body').on('click', '.copy', function () {
            let $parentTr = $(this).closest('tr');
            let $parentTd = $(this).closest('td');

            let urlField = $parentTr.get(0);
            $(this).parent('td').remove();

            // create a Range object
            let range = document.createRange();
            // set the Node to select the "range"
            range.selectNode(urlField);
            // add the Range to the set of window selections
            window.getSelection().addRange(range);

            // execute 'copy', can't 'cut' in this case
            document.execCommand('copy');

            window.getSelection().removeAllRanges();
            $parentTr.prepend($parentTd);

            /*
            let tmpElement = $('<textarea style="opacity:0;"></textarea>');
            let parent = $(this).closest('td').siblings().each(function () {
                tmpElement.html(tmpElement.html() + $(this).html() + '\t'); //
            });

            tmpElement.appendTo($('body')).focus().select();
            document.execCommand("copy");
            tmpElement.remove();
            */
        })

    });
</script>
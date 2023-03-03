<TABLE>
    <?php $back = ''; ?>
    <?php foreach ($orders as $item): ?>
        <?php $order = OrderParser::parseOrder($item); ?>

        <?php if (!$order->address || !$order->deliveryProvider) : ?>
            <?php $back = "style='background-color: red'>";?>
        <?php endif ?>

    <TR <?=$back?> >
        <TD>
            <BUTTON class="copy">Copy</BUTTON>
            <!--<DIV><?=$order->store?> <?=$order->name?></DIV>-->
        </TD>
        <TD><?=$order->store?></TD>
        <TD><?=$order->name?></TD>
        <TD><?=$order->phone?></TD>
        <TD><?=$order->address?></TD>
        <TD><?=$order->date?></TD>
        <TD><?=$order->id?></TD>
        <TD><?=$order->price?></TD>
        <TD><?=$order->deliveryProvider?></TD>
        <TD><?=$order->description?></TD>
        <TD><?=$order->purchaseType?></TD>
        <!--<TD><?=strtoupper($order->status)?></TD>-->
    </TR>

    <?php endforeach; ?>
</TABLE>

<script>
    $(document).ready(function() {

        $('body').on('click', '.copy', function (){
            let tmpElement = $('<textarea style="opacity:0;"></textarea>');
            let parent = $(this).closest('td').siblings().each(function(){
                tmpElement.text(tmpElement.text() + $(this).text() + '\t');
            });

            tmpElement.appendTo($('body')).focus().select();
            document.execCommand("copy");
            tmpElement.remove();
        })

    });
</script>
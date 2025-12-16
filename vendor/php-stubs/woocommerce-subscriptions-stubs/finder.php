<?php

return \StubsGenerator\Finder::create()
    ->in('woocommerce-subscriptions/includes')
    ->notPath('api/legacy')
    ->notPath('admin/views')
    ->notPath('core/data-stores/class-wcs-orders-table-data-store-controller.php')
    ->notPath('core/data-stores/class-wcs-orders-table-subscription-data-store.php')
    ->sortByName(true)
;

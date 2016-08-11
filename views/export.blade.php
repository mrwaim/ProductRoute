<table>
    <tr>
        <td>Target Group</td>
        <td>Target Role</td>
        <td>Name</td>
        <td>Price</td>
        <td>Price East</td>
        <td>Delivery</td>
        <td>Delivery East</td>
        <td>Min Order</td>
        <td>Max Order</td>
        <td>Description</td>
        <td>Bonus</td>
        <td>New User</td>
        <td>For Customer</td>
        <td>Is Membership</td>
        <td>Membership Group</td>
        <td>Is Hidden</td>
        <td>Is HQ</td>
        <td>Award Parent</td>
        <td>Max Purchase Count</td>
        <td>Expiry Date</td>
        <td>Biokare</td>
        <td>Biokare East</td>
        <td>Biokare Pickup</td>
        <td>Susu</td>
        <td>Susu East</td>
        <td>Susu Pickup</td>
        <td>Vteen</td>
        <td>Vteen East</td>
        <td>Vteen Pickup</td>
        <td>GStar</td>
        <td>GStar East</td>
        <td>GStar Pickup</td>
        <td>Biokare Membership</td>
        <td>Biokare Membership East</td>
        <td>Biokare Membership Pickup</td>
        <td>GStar Membership</td>
        <td>GStar Membership East</td>
        <td>GStar Membership Pickup</td>
        <td>Image</td>
    </tr>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->group ? $product->group->name : ''}}</td>
            <td>{{ $product->role ? ucfirst($product->role->name) : '' }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->price_east }}</td>
            <td>{{ $product->delivery }}</td>
            <td>{{ $product->delivery_east }}</td>
            <td>{{ $product->mix_quantity }}</td>
            <td>{{ $product->max_quantity }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->bonusCategory ? $product->bonusCategory->name : '' }}</td>
            <td>{{ $product->new_user ? 'YES' : 'NO' }}</td>
            <td>{{ $product->for_customer ? 'YES' : 'NO' }}</td>
            <td>{{ $product->is_membership ? 'YES' : 'NO' }}</td>
            <td>{{ $product->membershipGroup ? $product->membershipGroup->name : '' }}</td>
            <td>{{ $product->hidden_from_ordering ? 'YES' : 'No' }}</td>
            <td>{{ $product->is_hq ? 'YES' : 'No' }}</td>
            <td>{{ $product->award_parent ? 'YES' : 'No' }}</td>
            <td>{{ $product->max_purchase_count }}</td>
            <td>{{ $product->expiry_date }}</td>
            <?php
            $biokareUnit = $product->units()->where('name', 'biokare')->first();
            $biokareQuantity = '';
            $biokareQuantityEast = '';
            $biokareQuantityPickup = '';
            if ($biokareUnit) {
                $biokareQuantity = $biokareUnit->pivot->quantity;
                $biokareQuantityEast = $biokareUnit->pivot->quantity_east;
                $biokareQuantityPickup = $biokareUnit->pivot->quantity_pickup;
            }
            ?>
            <td>{{ $biokareQuantity }}</td>
            <td>{{ $biokareQuantityEast }}</td>
            <td>{{ $biokareQuantityPickup }}</td>
            <?php
            $susuUnit = $product->units()->where('name', 'susu')->first();
            $susuQuantity = '';
            $susuQuantityEast = '';
            $susuQuantityPickup = '';
            if ($susuUnit) {
                $susuQuantity = $susuUnit->pivot->quantity;
                $susuQuantityEast = $susuUnit->pivot->quantity_east;
                $susuQuantityPickup = $susuUnit->pivot->quantity_pickup;
            }
            ?>
            <td>{{ $susuQuantity }}</td>
            <td>{{ $susuQuantityEast }}</td>
            <td>{{ $susuQuantityPickup }}</td>
            <?php
            $vteenUnit = $product->units()->where('name', 'vteen')->first();
            $vteenQuantity = '';
            $vteenQuantityEast = '';
            $vteenQuantityPickup = '';
            if ($vteenUnit) {
                $vteenQuantity = $vteenUnit->pivot->quantity;
                $vteenQuantityEast = $vteenUnit->pivot->quantity_east;
                $vteenQuantityPickup = $vteenUnit->pivot->quantity_pickup;
            }
            ?>
            <td>{{ $vteenQuantity }}</td>
            <td>{{ $vteenQuantityEast }}</td>
            <td>{{ $vteenQuantityPickup }}</td>
            <?php
                $gstarUnit = $product->units()->where('name', 'gstar')->first();
                $gstarQuantity = '';
                $gstarQuantityEast = '';
                $gstarQuantityPickup = '';
                if ($gstarUnit) {
                    $gstarQuantity = $gstarUnit->pivot->quantity;
                    $gstarQuantityEast = $gstarUnit->pivot->quantity_east;
                    $gstarQuantityPickup = $gstarUnit->pivot->quantity_pickup;
                }
            ?>
            <td>{{ $gstarQuantity }}</td>
            <td>{{ $gstarQuantityEast }}</td>
            <td>{{ $gstarQuantityPickup }}</td>
            <?php
                $biokareMembershipUnit = $product->units()->where('name', 'biokare_membership')->first();
                $biokareMembershipQuantity = '';
                $biokareMembershipQuantityEast = '';
                $biokareMembershipQuantityPickup = '';
                if ($biokareMembershipUnit) {
                    $biokareMembershipQuantity = $biokareMembershipUnit->pivot->quantity;
                    $biokareMembershipQuantityEast = $biokareMembershipUnit->pivot->quantity_east;
                    $biokareMembershipQuantityPickup = $biokareMembershipUnit->pivot->quantity_pickup;
                }
            ?>
            <td>{{ $biokareMembershipQuantity }}</td>
            <td>{{ $biokareMembershipQuantityEast }}</td>
            <td>{{ $biokareMembershipQuantityPickup }}</td>
            <?php
                $gstarMembershipUnit = $product->units()->where('name', 'gstar_membership')->first();
                $gstarMembershipQuantity = '';
                $gstarMembershipQuantityEast = '';
                $gstarMembershipQuantityPickup = '';
                if ($gstarMembershipUnit) {
                    $gstarMembershipQuantity = $gstarMembershipUnit->pivot->quantity;
                    $gstarMembershipQuantityEast = $gstarMembershipUnit->pivot->quantity_east;
                    $gstarMembershipQuantityPickup = $gstarMembershipUnit->pivot->quantity_pickup;
                }
            ?>
            <td>{{ $gstarMembershipQuantity }}</td>
            <td>{{ $gstarMembershipQuantityEast }}</td>
            <td>{{ $gstarMembershipQuantityPickup }}</td>
            <td>{{ $product->image }}</td>
        </tr>
    @endforeach
</table>
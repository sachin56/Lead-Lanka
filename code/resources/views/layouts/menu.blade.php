 <!-- need to remove -->
 <li class="nav-item">
    <a href="" class="nav-link dashboard_route">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <p style="color: #C2C7D0; font-size: 15px; padding-top:10px">&nbsp;Master</p>
</li>

@role('Admin', 'admin')
    <li class="nav-item">
        <a href="" class="nav-link supplier_route">
        <i class="fas fa-table"></i>
            <p>&nbsp;Supplier</p>
        </a>
    </li>
    
    <li class="nav-item">
        <a href="book-category" class="nav-link Category_route">
        <i class="fas fa-table"></i>
            <p>&nbsp;Book Category</p>
        </a>
    </li>
@endrole



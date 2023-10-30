 <!-- need to remove -->
 <li class="nav-item">
    <a href="dashboard" class="nav-link dashboard_route">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <p style="color: #C2C7D0; font-size: 15px; padding-top:10px">&nbsp;Master</p>
</li>


    <li class="nav-item">
        <a href="book" class="nav-link book_route">
        <i class="fas fa-table"></i>
            <p>&nbsp;Book</p>
        </a>
    </li>
    @role('Admin', 'admin')  
        <li class="nav-item">
            <a href="book-category" class="nav-link Category_route">
            <i class="fas fa-table"></i>
                <p>&nbsp;Book Category</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="user" class="nav-link user_route">
            <i class="fas fa-table"></i>
                <p>&nbsp;Staff User</p>
            </a>
        </li>
    @endrole



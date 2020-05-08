<html> 
<head>   
<title>PAGINATION | CODEIGNITER 3</title>      

<!-- LOAD FILE CSS BOOTSTRAP -->   
<link rel="stylesheet" href="<?php echo base_url("css/bootstrap.min.css"); ?>"> 
</head> 
<body>   
<div class="container">   
<h1>Data Produk</h1><hr>      
<div class="table-responsive">     
<table class="table table-bordered">     
    <tr>       
        <th>ID</th>       
        <th>Vendor</th>       
        <th>Nama </th>       
        <th>Price</th>       
        <th>Description</th>
        <th>Category</th>
        <th>Quantity</th>     
    </tr> 
 
    <?php     
    if( ! empty($model['siswa']))
    { 
        // Jika data pada database tidak sama dengan empty (alias ada datanya)       
        foreach($model['siswa'] as $data)
        { 
            // Lakukan looping pada variabel siswa dari controller         
            echo "<tr>";         
            echo "<td>".$data->prod_id."</td>";         
            echo "<td>".$data->vend_name."</td>";         
            echo "<td>".$data->prod_name."</td>";         
            echo "<td>".$data->prod_price."</td>";         
            echo "<td>".$data->prod_desc."</td>";
            echo "<td>".$data->prod_image."</td>";
            echo "<td>".$data->cat_id."</td>";
            echo "<td>".$data->prod_qty."</td>";         
            echo "</tr>";       
        }     
            
    }else
    { 
        // Jika data tidak ada       
        echo "<tr><td colspan='5'>Data tidak ada</td></tr>";     
        }     
        
        ?>     
        
        </table>   
        
        </div>   
        
        <?php   
        // Tampilkan link-link paginationnya   
        echo $model['pagination'];   
        ?>   
        
    </div> 
</body> 

</html>
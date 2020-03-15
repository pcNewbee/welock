import java.io.*;
import java.net.*;
import java.sql.*;
import java.util.Arrays;
import java.util.Scanner;
import javax.servlet.ServletException;  
import javax.servlet.http.HttpServletRequest;  
import javax.servlet.http.HttpServletResponse;  
import java.util.concurrent.ArrayBlockingQueue;
import java.util.concurrent.BlockingQueue; 
public class HelloWorldServlet extends javax.servlet.http.HttpServlet implements javax.servlet.Servlet {  
    static final long serialVersionUID = 1L;  
      
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {  
       Connection ct=null;
                PreparedStatement ps=null;
                ResultSet rs=null;
                Socket s=null;


String lockid = request.getParameter("lockid");
        String user = request.getParameter("user");
        String action = request.getParameter("action");
	try{
        Class.forName("com.mysql.jdbc.Driver");
                                ct=DriverManager.getConnection("jdbc:mysql://127.0.0.1:3306/testWelock","testWelock","alkd56567");
                                ps=ct.prepareStatement("update user_lock set flag=? where user_id=?");
                                ps.setString(1, "1");
                                ps.setString(2, user);
                                ps.executeUpdate();



                                try {
                                        if(rs!=null){rs.close();}
                                        if(ps!=null){ps.close();}
                                        if(ct!=null){ct.close();}
                                } catch (Exception e) {
                                        e.printStackTrace();
                                }

}catch (Exception e){

        e.printStackTrace();
}
	 super.doGet(request, response);  
    }     
      
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {  
		Connection ct=null;
		PreparedStatement ps=null;
		ResultSet rs=null;
		Socket s=null;
		

    	response.setCharacterEncoding("UTF-8"); 
        response.setContentType("text/html");

    	String lockid = request.getParameter("lockid");
    	String user = request.getParameter("user");
    	String action = request.getParameter("action");

    	String flag="0";

    	if(action == null)
    	{
 			PrintWriter pr = response.getWriter();
 			try {
 				Class.forName("com.mysql.jdbc.Driver");		
				ct=DriverManager.getConnection("jdbc:mysql://127.0.0.1:3306/testWelock","testWelock","alkd56567");		
				ps=ct.prepareStatement("select * from user_lock where lock_id=?");			
				ps.setString(1, lockid);			
				rs=ps.executeQuery();
				while(rs.next())
				{						
					 if("1".equals(rs.getString("flag")))
					 		flag="1";
				}
			} catch (Exception e) {
				e.printStackTrace();
			} finally
			{
					try {
						if(rs!=null){rs.close();}
						if(ps!=null){ps.close();}
						if(ct!=null){ct.close();}
				} catch (Exception e) {
						e.printStackTrace();
				}
			}
 			 if("1".equals(flag)) 
    	 	{
      	 		try {
    	 			Class.forName("com.mysql.jdbc.Driver");
					ct=DriverManager.getConnection("jdbc:mysql://127.0.0.1:3306/testWelock","testWelock","alkd56567");
					ps=ct.prepareStatement("update user_lock set flag=? where lock_id=?");
					ps.setString(1, "0");
					ps.setString(2, lockid);
					ps.executeUpdate();
					} catch (Exception e) {
						e.printStackTrace();
					} finally
					{
						try {
							if(rs!=null){rs.close();}
							if(ps!=null){ps.close();}
							if(ct!=null){ct.close();}
						} catch (Exception e) {
							e.printStackTrace();
						}
					}
				pr.print("open"); 

    	 	} 
    	 	else{
    	  		pr.print("fail");
    	 	}

 			pr.flush();
         	pr.close();

    	} 
    	else{
    		PrintWriter out = response.getWriter();

			
			try {
				Class.forName("com.mysql.jdbc.Driver");
				ct=DriverManager.getConnection("jdbc:mysql://127.0.0.1:3306/testWelock","testWelock","alkd56567");
				ps=ct.prepareStatement("update user_lock set flag=? where user_id=?");
				ps.setString(1, "1");
				ps.setString(2, user);
				ps.executeUpdate();
			} catch (Exception e) {
				e.printStackTrace();
			} finally
			{
				try {
					if(rs!=null){rs.close();}
					if(ps!=null){ps.close();}
					if(ct!=null){ct.close();}
				} catch (Exception e) {
					e.printStackTrace();
				}
			}

    	    	out.println("<html>");
          	out.println("<head><title>Servlet</title></head>");
          	out.println("<body><h2>");
          	if("openid2".equals(user))
         		out.println(user);
         	else
         		out.println("fail");
          	out.println("</h2></body>");
          	out.println("</html>");

         	out.flush();
    		out.close();

    	}
         	super.doPost(request, response);
    }                 
} 

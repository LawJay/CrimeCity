<?php
	function getPage()
	{
		if(isset($_GET['page']))
		{
			$page = $_GET['page'];
			if($page == "index")
			{
				require_once("frontend/pages/index.php");
			}
			elseif($page == "contact")
			{
				require_once("frontend/pages/contact.php");
			}
			elseif($page == "login")
			{
				require_once("frontend/pages/login.php");
			}
			elseif($page == "register")
			{
				require_once("frontend/pages/register.php");
			}
			elseif($page == "logout")
			{
				session_destroy();
				echo "Logged out.";
				header("Location: index.php?msg=logoutsuccess");
				die();
			}
            elseif($page == "Chat")
            {
                require_once("frontend/pages/Chat.php");
            }

            elseif($page == "Chat2")
            {
                require_once("frontend/pages/Chat2.php");
            }
            elseif($page == "leaderboard")
            {
                require_once("frontend/pages/leaderboard.php");
            }
		}
		else
		{
			require_once("frontend/pages/index.php");
		}
	}
?>

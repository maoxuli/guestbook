<?php

/////////////////////////////////////////////////////////////////////
//
//     this is the xml operation class of guestbook
//
//     last modify was on 2004-12-27
//
/////////////////////////////////////////////////////////////////////

class xml_opration{


    var $string;
    var $data;
    var $filename;
    var $xml;
    var $size;
    var $total;


    //define xml file's name
    //get the file and put it into string
    function xml_opration(){
        $this->filename = XML_FILE;
        $this->xml = file_get_contents($this->filename);
        $this->size = RECORD_DISPLAY_COUNT;
    }


    //get xml file and return count of array
    function xmlFormat(){
        $parser = xml_parser_create();
        xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
        xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
        xml_parse_into_struct($parser,$this->xml,$values,$tags);
        xml_parser_free($parser);
        $this->total = intval(count($values)/7);
        //echo $this->total;
        //print_r($values);
    }


    //display records for appointed count
    function xmlPartFormat($page, $pagecount){
        if ($page == 1)
            $this->xml = preg_replace("/(.*)<message id=\"".($this->total-RECORD_DISPLAY_COUNT)."\">.*$/isU", "\\1</messages>", $this->xml);
        elseif($page == $pagecount)
            $this->xml = preg_replace("/(.*)(<message id=\"".($this->total-RECORD_DISPLAY_COUNT*($page-1))."\">.*$)/isU", "<?xml version='1.0' encoding=\"gb2312\"?>\n<messages>\\2", $this->xml);
        else{
            $this->xml = preg_replace("/(.*)(<message id=\"".($this->total-RECORD_DISPLAY_COUNT*($page-1))."\">.*<message id=\"".($this->total-RECORD_DISPLAY_COUNT*($page-1)-(RECORD_DISPLAY_COUNT-1))."\">.*<\/message>).*$/isU", "<?xml version=\"1.0\"?>\n<messages>\\2\n</messages>", $this->xml);
        }

        // to test above preg_replace function
        //and allow browser to see rss
        //BEGIN
        $fp = fopen (RSS_FILE, "w+");
        fwrite($fp, $this->xml);
        fclose ($fp);
        //END
        //
        $parser = xml_parser_create();
        xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
        xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
        xml_parse_into_struct($parser,$this->xml,$values,$tags);
        xml_parser_free($parser);
        return $values;
        //print_r($values);
    }


    //format some tags that can not red and write in xm file
    function formatXmlString($string){
        $trans = array("&" => "&amp;", ">" => "&gt;", "<" => "&lt;", "\"" => "&quot;", "'" => "&apos;");
        $this->string = strtr($string, $trans);
        return $this->string;
    }


    //insert xml file
    function insertXmlFile($id, $title, $author, $email, $web, $icon, $content){
        $this->xml = preg_replace("/^.*<messages>/is", "", $this->xml);

        Header("Content-type:text/xml");
        $this->data = "<?xml version=\"1.0\"?>\n";
        $this->data.= "<messages>\n";
        $this->data.= "<message id=\"".$id."\">\n";
        $this->data.= "<title>".$title."</title>\n";
        $this->data.= "<author>".$author."</author>\n";
        $this->data.= "<email>".$email."</email>\n";
        $this->data.= "<web>".$web."</web>\n";
        $this->data.= "<icon>".$icon."</icon>\n";
        $this->data.= "<time>".date("d/m/Y, h:i:s a")."</time>\n";
        $this->data.= "<content>".$content."</content>\n";
        $this->data.= "</message>";
        $this->data.=$this->xml;
    }


    //update xml file
    function updateXmlFile($id, $title, $author, $content){
        $this->data = preg_replace("/<message id=\"".$id."\">.*<\/content>/isU",
                "<message id=\"".$id."\">\n<title>".$title."</title>\n<author>".$author."</author>\n<content>".$content."</content>", $this->xml);
    }


    //delete xml file
    function deleteXmlFile($id){
        $this->data = preg_replace("/<message id=\"".$id."\">.*<\/message>.*(<message id=\"".($id-1)."\">)/isU", "\\1", $this->xml);
    }


    //write in guestbook.xml
    function writeXmlFile(){
        $fp = fopen ($this->filename, "w+");
        fwrite($fp, $this->data);
        fclose ($fp);
    }


    //pagenite function
    //when record count exceed max display counts of a page ,it will be valid
    //and it return some global variables
    function page(){
        global $begin,$pagesize,$pagecount,$total,$pagestring,$page;
        if( isset($_GET['page']) ){
           $page = intval($_GET['page'] );
        }
        else
           $page = 1;

       $total = $this->total;
       $pagesize = $this->size;
       if ($total){
          if ($total<$pagesize)
             $pagecount=1;
          if ($total%$pagesize)
             $pagecount=(int)($total/$pagesize)+1;
          else $pagecount=$total/$pagesize;
        }
        else $pagecount=0;
        $pagestring="";
        $select="";
        if ($page==1)
           $pagestring.= FIRST_PAGE.SPACER.PREVIEW_PAGE.SPACER;
        else
           $pagestring.="<a href=?page=1>".FIRST_PAGE."</a>".SPACER."<a href=?page=".($page-1).">".PREVIEW_PAGE."</a>".SPACER;
        if ($page==$pagecount or $pagecount==0)
           $pagestring.= NEXT_PAGE.SPACER.LAST_PAGE;
        else
            $pagestring.="<a href=?page=".($page+1).">".NEXT_PAGE."</a>".SPACER."<a href=?page=".($pagecount).">".LAST_PAGE."</a>";
        $begin=$page*$pagesize;

     }
}

?>
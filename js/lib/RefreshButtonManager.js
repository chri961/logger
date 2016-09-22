/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function RefreshButtonManager(button,refresher){
    this.button=button;
    $(button).click(onClickBottone);
    this.ref=refresher;
}
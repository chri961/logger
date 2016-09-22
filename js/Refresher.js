/**
 * class Refresher
 * Gestisce la chiamata ciclica temporizzata di una funzione
 * esistono mtodi per abilitare / disabilitare
 */

/**
 * Costruttore
 * @param {type} msec intervallo tra due successive azioni di refresh
 * @param {type} refreshedFunction la funzione di callback
 * @returns {Refresher}
 */
 function Refresher(msec,refreshedFunction) {
  this.interval=msec;
  this.refreshedFunction=refreshedFunction;
  this.myJob=null;
}

/**
 * Innesca la temporizzazione
 * @returns {undefined}
 */
Refresher.prototype.start = function(){
  if (this.myJob==null){
    this.myJob=window.setInterval(this.refreshedFunction, this.interval);
    console.log("refresh enabled interval="+this.interval);
  }
}

/**
 * Ferma la temporizzazione
 * @returns {undefined}
 */
Refresher.prototype.stop = function(){
  if (this.myJob!=null){
    window.clearInterval(this.myJob);
    this.myJob=null;
    console.log("refresh disabled");
  }
}

/**
 * Determina se la temporizzazione è abilitata
 * @returns {Boolean}
 */
Refresher.prototype.getRunningStatus = function(){
  return this.myJob!=null;
}

/*
 * End of class Refresher
 */
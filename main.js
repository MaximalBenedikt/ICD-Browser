const BaseUrl="backend/"
/** 
 * Represents one Entity
 * @class
 * 
 */
class Entity{
    //Ident
    id=0; // EntityID
    //Relations
    parent=[]; // EntityID
    child=[]; // EntityID
    //Names
    names={} // release -> lang -> string
    //Data
    data={} // release -> lang -> array with informations
    //Link
    link={} //release -> lang -> string
    
    constructor (id, release, language, cb=()=>{}, debug_loadAll = true) {
        this.id = id;
        console.log(id)
        let submitData = {};
        
        if(this.id != 0) {
            submitData.entityId = id;
            if (fullEntity) {
                submitData.fullEntity = true;
            } 

            if (release!=undefined) {
                submitData.release = release;
            }

            if (language!=undefined) {
                submitData.language = language;
            }
        }
			
       console.log(BaseUrl + "getEntity.php");
        $.get(BaseUrl + "getEntity.php", submitData, (rawData)=>{
        console.log(rawData)
        	let data = JSON.parse(rawData);
            let dataRelease = data.releaseId;
            let dataLang = data[""];
            
            console.log(rawData);

            if (typeof this.link[dataRelease] != undefined) {}
        }).fail((data)=>{
        	  // alert("Error");
            console.log(data.getResponseHeader());
        });
    }
}

new Entity(0)
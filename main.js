const BaseUrl="backend/"
var Content = {};

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
    //Link
    link={} //release -> lang -> string
    
    constructor (id, release, language, cb=()=>{}, debug_loadAll = false) {
        if (Content[id]!=undefined) 
        this.id = id;
        console.log(id)
        let submitData = {};
        
        if(this.id != 0) {
            submitData.entityId = id;

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
            let dataLang = data["title"]["@language"];
            
            console.log(rawData);

            if (typeof this.link[dataRelease] != undefined) this.link[dataRelease] = {};
            if (typeof this.link[dataRelease][dataLang] != undefined) this.link[dataRelease][dataLang] = data["browserUrl"];

            if (typeof this.names[dataRelease] != undefined) this.names[dataRelease] = {};
            if (typeof this.names[dataRelease][dataLang] != undefined) this.names[dataRelease][dataLang] = data["title"]["@value"];

            data.child.forEach(newChild => {
                let newChildLink = newChild.split("/");
                this.child.push(newChildLink[newChildLink.length - 1]);
                if (debug_loadAll) {
                    setTimeout(function() {
                        new Entity(newChildLink[newChildLink.length - 1], undefined, undefined, fullEntity, ()=>{}, debug_loadAll);
                        }, 1500);
                }
            });


            Content[this.id] = this;
            console.log(this);
        })
    }
}

new Entity(0,undefined,undefined,false,()=>{},true);
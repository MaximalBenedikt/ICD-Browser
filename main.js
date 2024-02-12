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
    
    constructor (id, release, language, cb=()=>{}, debug_loadAll = false) {
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
				console.log(submitData)
        $.get(BaseUrl + "getEntity.php", submitData, (rawData)=>{
        		console.log(rawData)
            data = JSON.parse(rawData);
            let dataRelease = data.releaseId;
            let dataLang = data[""];
            
            console.log(rawData);

            console.log(typeof this.link[dataRelease])
        });
    }
}



//URL Informations: tabs=Id's&active=id
const BaseUrl = "icd.maximalbenedikt.de/backend/"
var Content = {} 

function LoadEntity(id, parentId, fullEntity=false, release, language) {
    if (Content[id]==undefined) {
        Content[id] = {
            "ID": id,
            "Parent": [parentId],
            "Child": [],
            "Data": {}
        }
    }

    getEntity(id, (data)=>{
        //ID aus Data ziehen
        let idRaw = rawParent.split("/");
        let entityId = idRaw[idRaw.length - 1];

        //Parents
        data["parent"].forEach(rawParent => {
            let idRaw = rawParent.split("/");
            let id = idRaw[idRaw.length - 1];
            if (!Content[entityId]["Parent"].includes(id)) 
                Content[entityId]["Parent"].push(id);
        });

        //Child
        data["child"].forEach(rawChild => {
            let idRaw = rawChild.split("/");
            let id = idRaw[idRaw.length - 1];
            if (!Content[entityId]["Child"].includes(id)) 
                Content[entityId]["Child"].push(id);
        });

        //Data

    }, fullEntity, release, language)
}

function getEntity(id, callback, fullEntity=false, release, language) {
    let submitData = {};
    // ID checken
    if (id == "" || isNaN(id)) {
        alert("Die Anfrage an den Server war fehlerhaft. Es muss eine ID angefordert werden.");
        return;
    } 
    //ID okay
    submitData["entityId"] = id;
    if (fullEntity) {
        submitData["fullEntity"] = true;
    } 

    if (release!=undefined) {
        submitData["release"] = release;
    }

    if (language!=undefined) {
        submitData["language"] = language;
    }

    $.get(BaseUrl + "getEntity.php", submitData, (data)=>{
        alert(data);
        callback(JSON.parse(data));
    });
}

new Entity(0);
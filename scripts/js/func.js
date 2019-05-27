function shuffle(arr) {
    res = [];

    for (let g = 0; g < arr.length; g ++){
        res.push(arr[g]);
    }

    for (let i = 0; i < res.length; i ++){
        const firstIndex = jsH.getRandNum(0,res.length - 1);
        const secondIndex = jsH.getRandNum(0,res.length - 1);
        var randElArr = res[firstIndex];
        var randElArr2 = res[secondIndex];
        res[secondIndex] = randElArr;
        res[firstIndex] = randElArr2;
    }

    return res;
}
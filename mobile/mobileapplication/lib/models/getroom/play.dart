class Play {
  final String _id;
  final String idques;
  final String idans;

  const Play(this._id, this.idques, this.idans);

  Play.fromJson(Map<String, dynamic> json)
      : _id = json['_id'] ?? "",
        idques = json['idques'],
        idans = json['idans'];
}

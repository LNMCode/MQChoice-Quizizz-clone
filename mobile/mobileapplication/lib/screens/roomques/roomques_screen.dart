import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_bloc.dart';
import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_event.dart';
import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_state.dart';
import 'package:mobileapplication/screens/roomques/components/roomques_body.dart';

class RoomQuesScreen extends StatefulWidget {
  final String iduser;
  final String idroom;

  const RoomQuesScreen({
    Key? key,
    required this.iduser,
    required this.idroom,
  }) : super(key: key);

  @override
  State<StatefulWidget> createState() => _RoomQuesScreenState();
}

class _RoomQuesScreenState extends State<RoomQuesScreen> {
  @override
  void initState() {
    super.initState();
    BlocProvider.of<GetRoomBloc>(context)
        .add(GetRoomEventRequested(widget.idroom));
  }

  @override
  Widget build(BuildContext context) {
    print('Room quest' + widget.iduser);
    return Scaffold(
      body: Center(
        child: BlocConsumer<GetRoomBloc, GetRoomState>(
          listener: (context, state) {},
          builder: (context, state) {
            if (state is GetRoomStateLoading) {
              return Center(child: CircularProgressIndicator());
            }
            if (state is GetRoomStateSuccess) {
              final roomReponse = state.room_response;
              final room = roomReponse.doc;
              return RoomQuesBody(iduser: widget.iduser, room: room);
            }
            if (state is GetRoomStateFail) {
              return Text('Something went wrong');
            }
            return Center(
              child: TextButton(
                onPressed: () {
                  BlocProvider.of<GetRoomBloc>(context)
                      .add(GetRoomEventRequested(widget.idroom));
                },
                child: Column(
                  children: [
                    Text('TextButton'),
                    Text(widget.iduser),
                  ],
                ),
              ),
            );
          },
        ),
      ),
    );
  }
}
